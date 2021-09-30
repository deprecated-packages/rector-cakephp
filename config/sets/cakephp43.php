<?php

declare(strict_types=1);

use Rector\Renaming\Rector\MethodCall\RenameMethodRector;
use Rector\Renaming\ValueObject\MethodCallRename;
use Rector\Transform\Rector\Assign\PropertyFetchToMethodCallRector;
use Rector\Transform\Rector\MethodCall\MethodCallToAnotherMethodCallWithArgumentsRector;
use Rector\Transform\ValueObject\MethodCallToAnotherMethodCallWithArguments;
use Rector\Transform\ValueObject\PropertyFetchToMethodCall;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\SymfonyPhpConfig\ValueObjectInliner;

# source: https://book.cakephp.org/4.next/en/appendices/4-3-migration-guide.html
return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->set(RenameMethodRector::class)
        ->call('configure', [[
            RenameMethodRector::METHOD_CALL_RENAMES => ValueObjectInliner::inline([
                new MethodCallRename('Cake\Controller\Component', 'shutdown', 'afterFilter'),
            ]),
        ]]);

    $services->set(PropertyFetchToMethodCallRector::class)
        ->call('configure', [[
            PropertyFetchToMethodCallRector::PROPERTIES_TO_METHOD_CALLS => ValueObjectInliner::inline([
                new PropertyFetchToMethodCall('Cake\Network\Socket', 'connected', 'isConnected'),
                new PropertyFetchToMethodCall('Cake\Network\Socket', 'encrypted', 'isEncrypted'),
                new PropertyFetchToMethodCall('Cake\Network\Socket', 'lastError', 'lastError'),
            ]),
        ]]);

    $services->set(MethodCallToAnotherMethodCallWithArgumentsRector::class)
        ->call('configure', [[
            MethodCallToAnotherMethodCallWithArgumentsRector::METHOD_CALL_RENAMES_WITH_ADDED_ARGUMENTS =>
                ValueObjectInliner::inline([
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
                ]),
        ]]);
};
