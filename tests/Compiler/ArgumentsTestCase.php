<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Tests\Compiler;

use Railt\Compiler\Compiler;
use Railt\Compiler\Exceptions\TypeConflictException;
use Railt\Compiler\Reflection\CompilerInterface;
use Railt\Reflection\Contracts\Definitions\ObjectDefinition;
use Railt\Reflection\Contracts\Dependent\ArgumentDefinition;
use Railt\Reflection\Contracts\Dependent\FieldDefinition;
use Railt\Reflection\Filesystem\File;

/**
 * Class ArgumentDefaultsTestCase
 */
class ArgumentsTestCase extends AbstractCompilerTestCase
{
    private const ARGUMENT_BODY = 'type A { field(argument: %s): String }';

    /**
     * @return array
     * @throws \Psr\Cache\InvalidArgumentException
     * @throws \Railt\Compiler\Exceptions\CompilerException
     * @throws \Railt\Compiler\Exceptions\UnexpectedTokenException
     * @throws \Railt\Compiler\Exceptions\UnrecognizedTokenException
     */
    public function provider(): array
    {
        return \array_merge($this->positiveProvider(), $this->negativeProvider());
    }

    /**
     * @return array|CompilerInterface[]
     * @throws \League\Flysystem\FileNotFoundException
     * @throws \LogicException
     */
    public function compilersProvider(): array
    {
        $result = [];

        foreach ($this->getCompilers() as $compiler) {
            $result[] = [$compiler];
        }

        return $result;
    }

    /**
     * @return array
     * @throws \Psr\Cache\InvalidArgumentException
     * @throws \Railt\Compiler\Exceptions\CompilerException
     * @throws \Railt\Compiler\Exceptions\UnexpectedTokenException
     * @throws \Railt\Compiler\Exceptions\UnrecognizedTokenException
     */
    public function positiveProvider(): array
    {
        $schemas = [
            'String = null',
            '[String] = null',
            '[String!] = null',
            '[String]! = [null]',
            '[Int!]! = [1,2,3]',
            '[String!] = ["1","2","3"]',
        ];

        $result = [];

        foreach ($schemas as $schema) {
            $result[] = [\sprintf(self::ARGUMENT_BODY, $schema)];
        }

        return $result;
    }

    /**
     * @return array
     * @throws \Psr\Cache\InvalidArgumentException
     * @throws \Railt\Compiler\Exceptions\CompilerException
     * @throws \Railt\Compiler\Exceptions\UnexpectedTokenException
     * @throws \Railt\Compiler\Exceptions\UnrecognizedTokenException
     */
    public function negativeProvider(): array
    {
        $schemas = [
            // NonNull init by NULL
            'String! = null',
            // NonList init by List
            'String = []',
            // NonNullList init by NULL
            '[String]! = null',
            // ListOfNonNull init by List with NULL
            '[String!] = [1,null,3]',
        ];

        $result = [];

        foreach ($schemas as $schema) {
            $result[] = [\sprintf(self::ARGUMENT_BODY, $schema)];
        }

        return $result;
    }

    /**
     * @dataProvider positiveProvider
     *
     * @param string $schema
     * @return void
     * @throws \PHPUnit\Framework\AssertionFailedError
     * @throws \Throwable
     */
    public function testAllowedArgumentDefaultValue(string $schema): void
    {
        try {
            foreach ($this->getDocuments($schema) as $document) {
                /** @var ObjectDefinition $type */
                $type = $document->getTypeDefinition('A');
                static::assertNotNull($type, 'Type "A" not found');

                /** @var FieldDefinition $field */
                $field = $type->getField('field');
                static::assertNotNull($field, 'Field "field" not found');

                /** @var ArgumentDefinition $argument */
                $argument = $field->getArgument('argument');
                static::assertNotNull($argument, 'Argument "argument" not found');
            }
        } catch (\Throwable $e) {
            static::assertFalse(true,
                'This code is valid: ' . "\n> " . $schema . "\n" .
                'But exception thrown:' . "\n> " . $e->getMessage()
            );
            throw $e;
        }
    }

    /**
     * @dataProvider negativeProvider
     *
     * @param string $schema
     * @return void
     * @throws \League\Flysystem\FileNotFoundException
     * @throws \LogicException
     * @throws \PHPUnit\Framework\AssertionFailedError
     * @throws \Railt\Compiler\Exceptions\CompilerException
     * @throws \Railt\Compiler\Exceptions\TypeNotFoundException
     * @throws \Railt\Compiler\Exceptions\UnexpectedTokenException
     * @throws \Railt\Compiler\Exceptions\UnrecognizedTokenException
     */
    public function testInvalidArgumentDefaultValue(string $schema): void
    {
        $compilers = $this->getCompilers();

        /** @var Compiler $compiler */
        foreach ($compilers as $compiler) {
            try {
                $compiler->compile(File::fromSources($schema));
                static::assertFalse(true,
                    'Default value must throw an exception: ' . "\n" . $schema);
            } catch (TypeConflictException $error) {
                static::assertTrue(true);
            }
        }
    }

    /**
     * @dataProvider compilersProvider
     * @param CompilerInterface $compiler
     * @return void
     * @throws \PHPUnit\Framework\Exception
     */
    public function testValidInputArgumentType(CompilerInterface $compiler): void
    {
        $document = $compiler->compile(File::fromSources(<<<'GraphQL'
type User {}
input Where { field: String!, eq: Any, op: String! = "=" }


type UsersRepository {
    # Test input compatibility 
    find(where: Where! = {field: "id", eq: 42}): User
}
GraphQL
));
        /** @var ArgumentDefinition $arg */
        $arg = $document->getTypeDefinition('UsersRepository')
            ->getField('find')
            ->getArgument('where');

        $default = $arg->getDefaultValue();

        // TODO Object?
        static::assertInternalType('array', $default);

        static::assertArrayHasKey('field', $default);
        static::assertArrayHasKey('op', $default);
        static::assertArrayHasKey('eq', $default); // Resolved from Input

        static::assertEquals('id', $default['field'] ?? null);
        static::assertEquals('=', $default['op'] ?? null);
        static::assertEquals(42, $default['eq'] ?? null);
    }

    /**
     * @dataProvider compilersProvider
     * @param CompilerInterface $compiler
     * @return void
     * @throws \PHPUnit\Framework\Exception
     */
    public function testValidInputArgumentListType(CompilerInterface $compiler): void
    {
        $document = $compiler->compile(File::fromSources(<<<'GraphQL'
type User {}
input Where { field: String!, eq: Any, op: String! = "=" }


type UsersRepository {
    # List allow defained by compatible list
    findAll(where: [Where!] = [{field: "id", eq: 42}]): [User!] 
}
GraphQL
        ));
        /** @var ArgumentDefinition $arg */
        $arg = $document->getTypeDefinition('UsersRepository')
            ->getField('findAll')
            ->getArgument('where');

        $default = $arg->getDefaultValue();

        static::assertInternalType('array', $default);

        foreach ((array)$default as $item) {
            // TODO Object?
            static::assertInternalType('array', $item);

            static::assertArrayHasKey('field', $item);
            static::assertArrayHasKey('op', $item);
            static::assertArrayHasKey('eq', $item); // Resolved from Input

            static::assertEquals('id', $item['field'] ?? null);
            static::assertEquals('=', $item['op'] ?? null);
            static::assertEquals(42, $item['eq'] ?? null);
        }
    }

    /**
     * @dataProvider compilersProvider
     * @param CompilerInterface $compiler
     * @return void
     * @throws \PHPUnit\Framework\Exception
     */
    public function testValidInputArgumentListTypeWithLazyCasting(CompilerInterface $compiler): void
    {
        $document = $compiler->compile(File::fromSources(<<<'GraphQL'
type User {}
input Where { field: String!, eq: Any, op: String! = "=" }


type UsersRepository {
    # {field: ...} should auto transform to [{field: ...}] 
    findAll(where: [Where!] = {field: "id", op: "<>", eq: 42}): [User!]
}
GraphQL
        ));
        /** @var ArgumentDefinition $arg */
        $arg = $document->getTypeDefinition('UsersRepository')
            ->getField('findAll')
            ->getArgument('where');

        $default = $arg->getDefaultValue();

        static::assertInternalType('array', $default);

        foreach ((array)$default as $item) {
            // TODO Object?
            static::assertInternalType('array', $item);

            static::assertArrayHasKey('field', $item);
            static::assertArrayHasKey('op', $item);
            static::assertArrayHasKey('eq', $item); // Resolved from Input

            static::assertEquals('id', $item['field'] ?? null);
            static::assertEquals('<>', $item['op'] ?? null);
            static::assertEquals(42, $item['eq'] ?? null);
        }
    }

    /**
     * @dataProvider compilersProvider
     * @param CompilerInterface $compiler
     * @return void
     * @throws \PHPUnit\Framework\Exception
     */
    public function testInputArgumentWithIncompatibleDefaultValue(CompilerInterface $compiler): void
    {
        $this->expectException(TypeConflictException::class);

        $compiler->compile(File::fromSources(<<<'GraphQL'
type User {}
input Where { field: String!, eq: Any, op: String! = "=" }


type UsersRepository {
    find(where: Where! = {some: "id"}): User # Field "some" does not exists in input "Where"
}
GraphQL
        ));
    }

    /**
     * @dataProvider compilersProvider
     *
     * @param CompilerInterface $compiler
     * @return void
     */
    public function testInvalidArgumentIntoDirective(CompilerInterface $compiler): void
    {
        $this->expectException(TypeConflictException::class);

        $compiler->compile(File::fromSources(<<<'GraphQL'
directive @some(foo: String) on TYPE_DEFINITION

type Other @some(bar: "Hey! Argument bar wasn't specified for this directive")  {
}
GraphQL
        ));
    }
}
