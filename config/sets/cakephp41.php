<?php

declare(strict_types=1);

use Rector\CakePHP\Rector\MethodCall\ModalToGetSetRector;
use Rector\CakePHP\ValueObject\ModalToGetSet;
use Rector\Renaming\Rector\MethodCall\RenameMethodRector;
use Rector\Renaming\Rector\Name\RenameClassRector;
use Rector\Renaming\ValueObject\MethodCallRename;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->set(RenameClassRector::class)
        ->configure([
            'Cake\Routing\Exception\RedirectException' => 'Cake\Http\Exception\RedirectException',
            'Cake\Database\Expression\Comparison' => 'Cake\Database\Expression\ComparisonExpression',
        ]);

    $services->set(RenameMethodRector::class)
        ->configure([
            new MethodCallRename('Cake\Database\Schema\TableSchema', 'getPrimary', 'getPrimaryKey'),
            new MethodCallRename('Cake\Database\Type\DateTimeType', 'setTimezone', 'setDatabaseTimezone'),
            new MethodCallRename('Cake\Database\Expression\QueryExpression', 'or_', 'or'),
            new MethodCallRename('Cake\Database\Expression\QueryExpression', 'and_', 'and'),
            new MethodCallRename('Cake\View\Form\ContextInterface', 'primaryKey', 'getPrimaryKey'),
            new MethodCallRename(
                'Cake\Http\Middleware\CsrfProtectionMiddleware',
                'whitelistCallback',
                'skipCheckCallback'
            ),
        ]);

    $services->set(ModalToGetSetRector::class)
        ->configure([new ModalToGetSet('Cake\Form\Form', 'schema')]);
};
