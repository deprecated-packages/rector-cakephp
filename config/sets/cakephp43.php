<?php

declare(strict_types=1);

use Rector\CakePHP\Rector\MethodCall\RemoveIntermediaryMethodRector;
use Rector\CakePHP\ValueObject\RemoveIntermediaryMethod;
use Rector\Renaming\Rector\MethodCall\RenameMethodRector;
use Rector\Renaming\ValueObject\MethodCallRename;
use Rector\Transform\Rector\Assign\PropertyFetchToMethodCallRector;
use Rector\Transform\Rector\MethodCall\MethodCallToAnotherMethodCallWithArgumentsRector;
use Rector\Transform\ValueObject\MethodCallToAnotherMethodCallWithArguments;
use Rector\Transform\ValueObject\PropertyFetchToMethodCall;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

# source: https://book.cakephp.org/4.next/en/appendices/4-3-migration-guide.html
return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->set(RenameMethodRector::class)
        ->configure([new MethodCallRename('Cake\Controller\Component', 'shutdown', 'afterFilter')]);

    $services->set(PropertyFetchToMethodCallRector::class)
        ->configure([
            new PropertyFetchToMethodCall('Cake\Network\Socket', 'connected', 'isConnected'),
            new PropertyFetchToMethodCall('Cake\Network\Socket', 'encrypted', 'isEncrypted'),
            new PropertyFetchToMethodCall('Cake\Network\Socket', 'lastError', 'lastError'),
        ]);

    $services->set(RemoveIntermediaryMethodRector::class)
        ->configure([new RemoveIntermediaryMethod('getTableLocator', 'get', 'fetchTable')]);

    $services->set(MethodCallToAnotherMethodCallWithArgumentsRector::class)
        ->configure([
            new MethodCallToAnotherMethodCallWithArguments(
                'Cake\Database\DriverInterface',
                'supportsQuoting',
                'supports',
                ['quote'],
            ),
            new MethodCallToAnotherMethodCallWithArguments(
                'Cake\Database\DriverInterface',
                'supportsSavepoints',
                'supports',
                ['savepoint']
            ),
        ]);
};
