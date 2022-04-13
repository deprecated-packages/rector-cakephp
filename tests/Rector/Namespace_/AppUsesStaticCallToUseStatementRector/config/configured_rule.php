<?php

declare(strict_types=1);

use Rector\CakePHP\Rector\Namespace_\AppUsesStaticCallToUseStatementRector;

use Rector\Config\RectorConfig;

return static function (RectorConfig $containerConfigurator): void {
    $containerConfigurator->import(__DIR__ . '/../../../../../config/config.php');

    $services = $containerConfigurator->services();

    $services->set(AppUsesStaticCallToUseStatementRector::class);
};
