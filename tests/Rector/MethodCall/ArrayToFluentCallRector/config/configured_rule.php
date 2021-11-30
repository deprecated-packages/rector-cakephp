<?php

declare(strict_types=1);

use Rector\CakePHP\Rector\MethodCall\ArrayToFluentCallRector;
use Rector\CakePHP\Tests\Rector\MethodCall\ArrayToFluentCallRector\Source\ConfigurableClass;
use Rector\CakePHP\Tests\Rector\MethodCall\ArrayToFluentCallRector\Source\FactoryClass;
use Rector\CakePHP\ValueObject\ArrayToFluentCall;
use Rector\CakePHP\ValueObject\FactoryMethod;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->import(__DIR__ . '/../../../../../config/config.php');

    $services = $containerConfigurator->services();
    $services->set(ArrayToFluentCallRector::class)
        ->configure([
            ArrayToFluentCallRector::ARRAYS_TO_FLUENT_CALLS => [
                new ArrayToFluentCall(ConfigurableClass::class, [
                    'name' => 'setName',
                    'size' => 'setSize',
                ]),
            ],
            ArrayToFluentCallRector::FACTORY_METHODS => [
                new FactoryMethod(FactoryClass::class, 'buildClass', ConfigurableClass::class, 2),
            ],
        ]);
};
