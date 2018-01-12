<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\GraphQL\Reflection\Builder\Invocations;

use Railt\Compiler\Ast\NodeInterface;
use Railt\Compiler\Ast\RuleInterface;
use Railt\GraphQL\Reflection\Builder\DocumentBuilder;
use Railt\GraphQL\Reflection\Builder\Process\Compilable;
use Railt\GraphQL\Reflection\Builder\Process\Compiler;
use Railt\Reflection\Base\Invocations\BaseDirectiveInvocation;
use Railt\Reflection\Contracts\Definitions\TypeDefinition;
use Railt\Reflection\Contracts\Document;

/**
 * Class DirectiveInvocationBuilder
 */
class DirectiveInvocationBuilder extends BaseDirectiveInvocation implements Compilable
{
    use Compiler;

    /**
     * DirectiveInvocationBuilder constructor.
     * @param NodeInterface $ast
     * @param DocumentBuilder|Document $document
     * @param TypeDefinition $parent
     * @throws \Railt\GraphQL\Exceptions\TypeConflictException
     */
    public function __construct(NodeInterface $ast, DocumentBuilder $document, TypeDefinition $parent)
    {
        $this->parent = $parent;
        $this->boot($ast, $document);
    }

    /**
     * @param NodeInterface $ast
     * @return bool
     * @throws \Railt\GraphQL\Exceptions\TypeConflictException
     */
    protected function onCompile(NodeInterface $ast): bool
    {
        if ($ast->is('#Argument')) {
            [$name, $value] = $this->parseArgumentValue($ast);

            $this->arguments[$name] = $this->parseValue($value, $this->getName());

            return true;
        }

        return false;
    }

    /**
     * @param NodeInterface|RuleInterface $ast
     * @return array
     */
    private function parseArgumentValue(NodeInterface $ast): array
    {
        [$key, $value] = [null, null];

        foreach ($ast->getChildren() as $child) {
            if ($child->is('#Name')) {
                $key = $child->getChild(0)->getValue();
                continue;
            }

            if ($child->is('#Value')) {
                $value = $child->getChild(0);
                continue;
            }
        }

        return [$key, $value];
    }

    /**
     * @return null|TypeDefinition
     */
    public function getTypeDefinition(): ?TypeDefinition
    {
        return $this->load($this->getName());
    }
}
