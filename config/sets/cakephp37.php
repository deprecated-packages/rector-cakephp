<?php

declare(strict_types=1);

use Rector\CakePHP\Rector\MethodCall\ModalToGetSetRector;
use Rector\CakePHP\Rector\Property\ChangeSnakedFixtureNameToPascalRector;
use Rector\CakePHP\ValueObject\ModalToGetSet;
use Rector\Renaming\Rector\MethodCall\RenameMethodRector;
use Rector\Renaming\ValueObject\MethodCallRename;
use Rector\Transform\Rector\Assign\PropertyFetchToMethodCallRector;
use Rector\Transform\Rector\MethodCall\MethodCallToAnotherMethodCallWithArgumentsRector;
use Rector\Transform\ValueObject\MethodCallToAnotherMethodCallWithArguments;
use Rector\Transform\ValueObject\PropertyFetchToMethodCall;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

# source: https://book.cakephp.org/3.0/en/appendices/3-7-migration-guide.html
return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->set(RenameMethodRector::class)
        ->configure([
            new MethodCallRename('Cake\Form\Form', 'errors', 'getErrors'),
            new MethodCallRename('Cake\Validation\Validation', 'cc', 'creditCard'),
            new MethodCallRename('Cake\Filesystem\Folder', 'normalizePath', 'correctSlashFor'),
            new MethodCallRename('Cake\Http\Client\Response', 'body', 'getStringBody'),
            new MethodCallRename('Cake\Core\Plugin', 'unload', 'clear'),
        ]);

    $services->set(PropertyFetchToMethodCallRector::class)
        ->configure([
            new PropertyFetchToMethodCall('Cake\Http\Client\Response', 'body', 'getStringBody'),
            new PropertyFetchToMethodCall('Cake\Http\Client\Response', 'json', 'getJson'),
            new PropertyFetchToMethodCall('Cake\Http\Client\Response', 'xml', 'getXml'),
            new PropertyFetchToMethodCall('Cake\Http\Client\Response', 'cookies', 'getCookies'),
            new PropertyFetchToMethodCall('Cake\Http\Client\Response', 'code', 'getStatusCode'),

            new PropertyFetchToMethodCall('Cake\View\View', 'request', 'getRequest', 'setRequest'),
            new PropertyFetchToMethodCall('Cake\View\View', 'response', 'getResponse', 'setResponse'),
            new PropertyFetchToMethodCall('Cake\View\View', 'templatePath', 'getTemplatePath', 'setTemplatePath'),
            new PropertyFetchToMethodCall('Cake\View\View', 'template', 'getTemplate', 'setTemplate'),
            new PropertyFetchToMethodCall('Cake\View\View', 'layout', 'getLayout', 'setLayout'),
            new PropertyFetchToMethodCall('Cake\View\View', 'layoutPath', 'getLayoutPath', 'setLayoutPath'),
            new PropertyFetchToMethodCall(
                'Cake\View\View',
                'autoLayout',
                'isAutoLayoutEnabled',
                'enableAutoLayout'
            ),
            new PropertyFetchToMethodCall('Cake\View\View', 'theme', 'getTheme', 'setTheme'),
            new PropertyFetchToMethodCall('Cake\View\View', 'subDir', 'getSubDir', 'setSubDir'),
            new PropertyFetchToMethodCall('Cake\View\View', 'plugin', 'getPlugin', 'setPlugin'),
            new PropertyFetchToMethodCall('Cake\View\View', 'name', 'getName', 'setName'),
            new PropertyFetchToMethodCall('Cake\View\View', 'elementCache', 'getElementCache', 'setElementCache'),
            new PropertyFetchToMethodCall('Cake\View\View', 'helpers', 'helpers'),
        ]);

    $services->set(MethodCallToAnotherMethodCallWithArgumentsRector::class)
        ->configure([
            new MethodCallToAnotherMethodCallWithArguments('Cake\Database\Query', 'join', 'clause', ['join']),
            new MethodCallToAnotherMethodCallWithArguments('Cake\Database\Query', 'from', 'clause', ['from']),
        ]);

    $services->set(ModalToGetSetRector::class)
        ->configure([
            new ModalToGetSet(
                'Cake\Database\Connection',
                'logQueries',
                'isQueryLoggingEnabled',
                'enableQueryLogging'
            ),
            new ModalToGetSet('Cake\ORM\Association', 'className', 'getClassName', 'setClassName'),
        ]);

    $services->set(ChangeSnakedFixtureNameToPascalRector::class);
};
