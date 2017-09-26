<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Tests\Reflection;

use Railt\Reflection\Contracts\Document;
use Railt\Reflection\Contracts\Types\ScalarType;

/**
 * Class ScalarTestCase
 */
class ScalarTestCase extends AbstractReflectionTestCase
{
    /**
     * @return array
     * @throws \Psr\Cache\InvalidArgumentException
     * @throws \Railt\Parser\Exceptions\CompilerException
     * @throws \Railt\Parser\Exceptions\UnexpectedTokenException
     * @throws \Railt\Parser\Exceptions\UnrecognizedTokenException
     */
    public function provider(): array
    {
        $schema = <<<GraphQL
"""
    This a test scalar using inside only this test case.
    Defined by "scalar Test" declaration.
"""
scalar Test @deprecated(reason: """
    Why not?
""")
GraphQL;

        return [
            [$this->getDocument($schema)],
            [$this->getCachedDocument($schema)],
        ];
    }

    /**
     * @dataProvider provider
     *
     * @param Document $document
     * @return void
     */
    public function testScalarName(Document $document): void
    {
        /** @var ScalarType $scalar */
        $scalar = $document->getType('Test');

        static::assertNotNull($scalar);
        static::assertSame('Test', $scalar->getName());
        static::assertSame(
            'This a test scalar using inside only this test case.' . "\n" .
            'Defined by "scalar Test" declaration.',
            $scalar->getDescription()
        );
        static::assertSame('Scalar', $scalar->getTypeName());
    }


    /**
     * @dataProvider provider
     *
     * @param Document $document
     * @return void
     */
    public function testScalarType(Document $document): void
    {
        /** @var ScalarType $scalar */
        $scalar = $document->getType('Test');
        static::assertNotNull($scalar);

        static::assertSame('Scalar', $scalar->getTypeName());
    }


    /**
     * @dataProvider provider
     *
     * @param Document $document
     * @return void
     */
    public function testScalarDescription(Document $document): void
    {
        /** @var ScalarType $scalar */
        $scalar = $document->getType('Test');
        static::assertNotNull($scalar);

        $description =
            'This a test scalar using inside only this test case.' . "\n" .
            'Defined by "scalar Test" declaration.';

        static::assertSame($description, $scalar->getDescription());
    }

    /**
     * @dataProvider provider
     *
     * @param Document $document
     * @return void
     * @throws \PHPUnit\Framework\AssertionFailedError
     */
    public function testScalarDeprecation(Document $document): void
    {
        /** @var ScalarType $scalar */
        $scalar = $document->getType('Test');
        static::assertNotNull($scalar);

        static::assertTrue($scalar->isDeprecated());
    }

    /**
     * @dataProvider provider
     *
     * @param Document $document
     * @return void
     * @throws \PHPUnit\Framework\AssertionFailedError
     */
    public function testScalarDeprecationReason(Document $document): void
    {
        /** @var ScalarType $scalar */
        $scalar = $document->getType('Test');
        static::assertNotNull($scalar);

        $reason = "\n" . '    Why not?'. "\n";

        static::assertSame($reason, $scalar->getDeprecationReason());
    }
}
