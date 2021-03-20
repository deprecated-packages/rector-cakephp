<?php

namespace aRector\CakePHP\Tests\Rector\MethodCall\ModalToGetSetRector\Fixture;

use aRector\CakePHP\Tests\Rector\MethodCall\ModalToGetSetRector\Source;

function modalToGetSet4()
{
    $object = new Source\SomeModelType;

    $object->makeEntity();
}

?>
-----
<?php

namespace aRector\CakePHP\Tests\Rector\MethodCall\ModalToGetSetRector\Fixture;

use aRector\CakePHP\Tests\Rector\MethodCall\ModalToGetSetRector\Source;

function modalToGetSet4()
{
    $object = new Source\SomeModelType;

    $object->createEntity();
}

?>
