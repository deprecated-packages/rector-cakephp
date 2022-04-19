<?php

declare(strict_types=1);

use Rector\CakePHP\Set\CakePHPLevelSetList;
use Rector\CakePHP\Set\CakePHPSetList;
use Rector\Config\RectorConfig;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->sets([CakePHPSetList::CAKEPHP_41, CakePHPLevelSetList::UP_TO_CAKEPHP_40]);
};
