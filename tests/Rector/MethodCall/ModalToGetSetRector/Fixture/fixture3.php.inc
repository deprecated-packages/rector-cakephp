<?php

namespace aRector\CakePHP\Tests\Rector\MethodCall\ModalToGetSetRector\Fixture;

use aRector\CakePHP\Tests\Rector\MethodCall\ModalToGetSetRector\Source;

function modalToGetSet3()
{
    $object = new Source\SomeModelType;

    $config = $object->method();
    $config = $object->method('key');
}

?>
-----
<?php

namespace aRector\CakePHP\Tests\Rector\MethodCall\ModalToGetSetRector\Fixture;

use aRector\CakePHP\Tests\Rector\MethodCall\ModalToGetSetRector\Source;

function modalToGetSet3()
{
    $object = new Source\SomeModelType;

    $config = $object->getMethod();
    $config = $object->setMethod('key');
}

?>
