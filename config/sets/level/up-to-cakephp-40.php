<?php

declare(strict_types=1);

use Rector\CakePHP\Set\CakePHPLevelSetList;
use Rector\CakePHP\Set\CakePHPSetList;
use Rector\Config\RectorConfig;

return static function (RectorConfig $containerConfigurator): void {
    $containerConfigurator->import(CakePHPSetList::CAKEPHP_40);
    $containerConfigurator->import(CakePHPLevelSetList::UP_TO_CAKEPHP_38);
};
