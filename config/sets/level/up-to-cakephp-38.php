<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->import(\Rector\CakePHP\Set\CakePHPSetList::CAKEPHP_38);
    $containerConfigurator->import(\Rector\CakePHP\Set\CakePHPLevelSetList::UP_TO_CAKEPHP_37);
};
