<?php

namespace aRector\CakePHP\Tests\Rector\MethodCall\RenameMethodCallBasedOnParameterRector\Fixture;

use aRector\CakePHP\Tests\Rector\MethodCall\RenameMethodCallBasedOnParameterRector\Source;

function renameMethodCallBasedOnParameterNoop()
{
    $object = new Source\SomeModelType;

    $config = $object->getParam($value);
    $config = $object->getParam('other');
    $object->withParam('other', 'value');
}
