<?php

namespace aRector\CakePHP\Tests\Rector\MethodCall\ArrayToFluentCallRector\Fixture;

use aRector\CakePHP\Tests\Rector\MethodCall\ArrayToFluentCallRector\Source;

function arrayToFluentCall2()
{
    $factory = new Source\FactoryClass();

    $factory->buildClass('foo', [
        'name' => 'bar',
        'size' => 2,
    ]);

    $factory->buildClass('foo', ['name' => 'bar'])
        ->setSize(3)
        ->doSomething();

    $factory->buildClass('foo', [
        'name' => 'bar',
        'baz' => 4,
    ]);
}

?>
-----
<?php

namespace aRector\CakePHP\Tests\Rector\MethodCall\ArrayToFluentCallRector\Fixture;

use aRector\CakePHP\Tests\Rector\MethodCall\ArrayToFluentCallRector\Source;

function arrayToFluentCall2()
{
    $factory = new Source\FactoryClass();

    $factory->buildClass('foo')->setName('bar')->setSize(2);

    $factory->buildClass('foo')->setName('bar')
        ->setSize(3)
        ->doSomething();

    $factory->buildClass('foo', [
        'baz' => 4,
    ])->setName('bar');
}

?>
