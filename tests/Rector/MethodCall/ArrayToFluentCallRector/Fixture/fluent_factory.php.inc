<?php

namespace aRector\CakePHP\Tests\Rector\MethodCall\ArrayToFluentCallRector\Fixture;

use aRector\CakePHP\Tests\Rector\MethodCall\ArrayToFluentCallRector\Source;

function arrayToFluentCall()
{
    $factory = new Source\FactoryClass();

    $factory->buildClass('foo');

    $factory->buildClass('foo', []);

    $factory->buildClass('foo', ['baz' => 1]);
}

?>
-----
<?php

namespace aRector\CakePHP\Tests\Rector\MethodCall\ArrayToFluentCallRector\Fixture;

use aRector\CakePHP\Tests\Rector\MethodCall\ArrayToFluentCallRector\Source;

function arrayToFluentCall()
{
    $factory = new Source\FactoryClass();

    $factory->buildClass('foo');

    $factory->buildClass('foo');

    $factory->buildClass('foo', ['baz' => 1]);
}

?>
