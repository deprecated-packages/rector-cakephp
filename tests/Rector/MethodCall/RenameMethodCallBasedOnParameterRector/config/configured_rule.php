<?php

declare(strict_types=1);

use Rector\CakePHP\Rector\MethodCall\RenameMethodCallBasedOnParameterRector;
use Rector\CakePHP\Tests\Rector\MethodCall\RenameMethodCallBasedOnParameterRector\Source\SomeModelType;
use Rector\CakePHP\ValueObject\RenameMethodCallBasedOnParameter;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->import(__DIR__ . '/../../../../../config/config.php');

    $services = $containerConfigurator->services();
    $services->set(RenameMethodCallBasedOnParameterRector::class)
        ->configure([

            new RenameMethodCallBasedOnParameter(SomeModelType::class, 'getParam', 'paging', 'getAttribute'),
            new RenameMethodCallBasedOnParameter(SomeModelType::class, 'withParam', 'paging', 'withAttribute'),
        ]);
};
