<?php

declare(strict_types=1);

use Rector\CakePHP\Rector\MethodCall\RemoveIntermediaryMethodRector;
use Rector\CakePHP\ValueObject\RemoveIntermediaryMethod;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\SymfonyPhpConfig\ValueObjectInliner;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->import(__DIR__ . '/../../../../../config/config.php');

    $services = $containerConfigurator->services();
    $services->set(RemoveIntermediaryMethodRector::class)
        ->call('configure', [[
            RemoveIntermediaryMethodRector::REMOVE_INTERMEDIARY_METHOD => ValueObjectInliner::inline([
                new RemoveIntermediaryMethod('getTableLocator', 'get', 'fetchTable'),
            ]),
        ]]);
};
