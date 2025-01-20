<?php

namespace Test\Lucinda\Templating;

use Lucinda\Templating\UserTag;
use Lucinda\UnitTest\Result;

class UserTagTest
{
    public function parseStartTag()
    {
        $object = new UserTag(__DIR__."/tags/Greeting/client.html");
        return new Result($object->parseStartTag(["user"=>"Lucian"])=="<!-- VL:START: /home/aherne/work/framework/php-view-language-api/tests/tags/Greeting/client.html -->
Hello, Lucian!
<!-- VL:END: /home/aherne/work/framework/php-view-language-api/tests/tags/Greeting/client.html -->
");
    }
}
