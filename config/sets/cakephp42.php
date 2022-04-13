<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

use Rector\Renaming\Rector\MethodCall\RenameMethodRector;
use Rector\Renaming\Rector\Name\RenameClassRector;
use Rector\Renaming\ValueObject\MethodCallRename;

# source: https://book.cakephp.org/4/en/appendices/4-2-migration-guide.html
return static function (RectorConfig $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->set(RenameClassRector::class)
        ->configure([
            'Cake\Core\Exception\Exception' => 'Cake\Core\Exception\CakeException',
            'Cake\Database\Exception' => 'Cake\Database\Exception\DatabaseException',
        ]);

    $services->set(RenameMethodRector::class)
        ->configure([new MethodCallRename('Cake\ORM\Behavior', 'getTable', 'table')]);
};
