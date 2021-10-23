<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->import(\Rector\CakePHP\Set\CakePHPSetList::CAKEPHP_30);
    $containerConfigurator->import(\Rector\CakePHP\Set\CakePHPSetList::CAKEPHP_34);
};
