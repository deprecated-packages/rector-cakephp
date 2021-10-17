<?php

declare(strict_types=1);

namespace Rector\CakePHP\Rector\MethodCall;

use PhpParser\Node;
use PhpParser\Node\Expr\MethodCall;
use Rector\CakePHP\ValueObject\RemoveIntermediaryMethod;
use Rector\Core\Contract\Rector\ConfigurableRectorInterface;
use Rector\Core\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\ConfiguredCodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;
use Webmozart\Assert\Assert;

/**
 * @see https://book.cakephp.org/3.0/en/appendices/3-4-migration-guide.html#deprecated-combined-get-set-methods
 * @see https://github.com/cakephp/cakephp/commit/326292688c5e6d08945a3cafa4b6ffb33e714eea#diff-e7c0f0d636ca50a0350e9be316d8b0f9
 *
 * @see \Rector\CakePHP\Tests\Rector\MethodCall\ModalToGetSetRector\ModalToGetSetRectorTest
 */
final class RemoveIntermediaryMethodRector extends AbstractRector implements ConfigurableRectorInterface
{
    /**
     * @var \Rector\CakePHP\ValueObject\RemoveIntermediaryMethod[]
     */
    private array $replacements = [];

    /**
     * @var string
     */
    public const REMOVE_INTERMEDIARY_METHOD = 'remove_intermediary_method';

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Removes an intermediary method call for when a higher level API is added.',
            [
                new ConfiguredCodeSample(
                    <<<'CODE_SAMPLE'
$users = $this->getTableLocator()->get('Users');
CODE_SAMPLE
                    ,
                    <<<'CODE_SAMPLE'
$users = $this->fetchTable('Users');
CODE_SAMPLE
                    ,
                    [
                        self::REMOVE_INTERMEDIARY_METHOD => [new RemoveIntermediaryMethod('getTableLocator', 'get', 'fetchTable')],
                    ]
                ),
            ]
        );
    }

    /**
     * @return array<class-string<Node>>
     */
    public function getNodeTypes(): array
    {
        return [MethodCall::class];
    }

    /**
     * @param MethodCall $node
     */
    public function refactor(Node $node): ?Node
    {
        $replacement = $this->matchTypeAndMethodName($node);
        if (! $replacement instanceof RemoveIntermediaryMethod) {
            return null;
        }
        /** @var MethodCall $var */
        $var = $node->var;
        $target = $var->var;

        return new MethodCall($target, $replacement->getFinalMethod(), $node->args);
    }

    public function configure(array $configuration): void
    {
        /** @var \Rector\CakePHP\ValueObject\RemoveIntermediaryMethod[] $replacements */
        $replacements = $configuration[self::REMOVE_INTERMEDIARY_METHOD] ?? [];
        Assert::allIsInstanceOf($replacements, RemoveIntermediaryMethod::class);

        /** @var \Rector\CakePHP\ValueObject\RemoveIntermediaryMethod[] $replacements */
        $this->replacements = $replacements;
    }

    private function matchTypeAndMethodName(MethodCall $methodCall): ?RemoveIntermediaryMethod
    {
        foreach ($this->replacements as $replacement) {
            if (! $this->isName($methodCall->name, $replacement->getSecondMethod())) {
                continue;
            }
            if (! ($methodCall->var instanceof MethodCall)) {
                continue;
            }
            if (! $this->isName($methodCall->var->name, $replacement->getFirstMethod())) {
                continue;
            }

            return $replacement;
        }

        return null;
    }
}
