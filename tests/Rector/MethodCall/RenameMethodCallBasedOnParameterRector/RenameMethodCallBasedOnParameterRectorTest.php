<?php

declare(strict_types=1);

namespace Rector\CakePHP\Tests\Rector\MethodCall\RenameMethodCallBasedOnParameterRector;

use Rector\Testing\PHPUnit\AbstractRectorTestCase;

final class RenameMethodCallBasedOnParameterRectorTest extends AbstractRectorTestCase
{
    /**
     * @dataProvider provideData()
     */
    public function test(string $filePath): void
    {
        $this->doTestFile($filePath);
    }

    public function provideData(): \Iterator
    {
        return $this->yieldFilePathsFromDirectory(__DIR__ . '/Fixture');
    }

    public function provideConfigFilePath(): string
    {
        return __DIR__ . '/config/configured_rule.php';
    }
}
