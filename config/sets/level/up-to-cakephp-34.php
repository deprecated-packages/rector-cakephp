<?php

declare(strict_types=1);

use Rector\CakePHP\Set\CakePHPSetList;
use Rector\Config\RectorConfig;

return static function (RectorConfig $containerConfigurator): void {
    $containerConfigurator->import(CakePHPSetList::CAKEPHP_30);
    $containerConfigurator->import(CakePHPSetList::CAKEPHP_34);
};
