<?php

namespace Rector\CakePHP\Tests\Rector\MethodCall\ModalToGetSetRector\Fixture;

class Fixture
{
    function run()
    {
        $this->Users = $this->getTableLocator()->get('Users');
        $articles = $this->getTableLocator()->get('Articles', ['table' => 'alt_articles']);
        $comments = $this->getTableLocator()
            ->get('Comments');
    }
}

?>
-----
<?php

namespace Rector\CakePHP\Tests\Rector\MethodCall\ModalToGetSetRector\Fixture;

class Fixture
{
    function run()
    {
        $this->Users = $this->fetchTable('Users');
        $articles = $this->fetchTable('Articles', ['table' => 'alt_articles']);
        $comments = $this->fetchTable('Comments');
    }
}

?>
