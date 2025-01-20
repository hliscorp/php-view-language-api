<?php

namespace Test\Lucinda\Templating;

use Lucinda\Templating\UserTagParser;
use Lucinda\Templating\ViewCompilation;
use Lucinda\Templating\TagLib\System\NamespaceTag;
use Lucinda\Templating\TagLib\System\EscapeTag;
use Lucinda\UnitTest\Result;

class UserTagParserTest
{
    public function parse()
    {
        $object = new UserTagParser(
            new NamespaceTag(__DIR__."/tags"),
            "html",
            new ViewCompilation(dirname(__DIR__)."/compilations", "userTagParser", "html")
        );
        return new Result($object->parse('<p><Greeting:client user="Lucian"/></p>', new EscapeTag())=="<p><!-- VL:START: /home/aherne/work/framework/php-view-language-api/tests/tags/Greeting/client.html -->
Hello, Lucian!
<!-- VL:END: /home/aherne/work/framework/php-view-language-api/tests/tags/Greeting/client.html -->
</p>");
    }
}
