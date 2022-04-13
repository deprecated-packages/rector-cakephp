<?php

declare(strict_types=1);

use Rector\CakePHP\Rector\MethodCall\RemoveIntermediaryMethodRector;

use Rector\CakePHP\ValueObject\RemoveIntermediaryMethod;
use Rector\Config\RectorConfig;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->import(__DIR__ . '/../../../../../config/config.php');

    $services = $rectorConfig->services();
    $services->set(RemoveIntermediaryMethodRector::class)
        ->configure([new RemoveIntermediaryMethod('getTableLocator', 'get', 'fetchTable')]);
};
