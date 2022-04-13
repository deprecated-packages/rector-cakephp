<?php

declare(strict_types=1);

use Rector\CakePHP\Set\CakePHPLevelSetList;
use Rector\CakePHP\Set\CakePHPSetList;
use Rector\Config\RectorConfig;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->import(CakePHPSetList::CAKEPHP_36);
    $rectorConfig->import(CakePHPLevelSetList::UP_TO_CAKEPHP_35);
};
