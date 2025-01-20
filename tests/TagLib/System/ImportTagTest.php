<?php

namespace Test\Lucinda\Templating\TagLib\System;

use Lucinda\Templating\TagLib\System\ImportTag;
use Lucinda\Templating\ViewCompilation;
use Lucinda\Templating\TagLib\System\EscapeTag;
use Lucinda\UnitTest\Result;

class ImportTagTest
{
    public function parse()
    {
        $object = new ImportTag(dirname(__DIR__, 2)."/views", "html", new ViewCompilation(dirname(__DIR__, 3)."/compilations", "homepage", "html"));
        return new Result(
            $object->parse("homepage", new EscapeTag())=='<!-- VL:START: /home/aherne/work/framework/php-view-language-api/tests/views/homepage.html -->
<!-- VL:START: /home/aherne/work/framework/php-view-language-api/tests/views/header.html -->
<html>
<body>
<!-- VL:END: /home/aherne/work/framework/php-view-language-api/tests/views/header.html -->

Welcome to homepage!
<!-- VL:START: /home/aherne/work/framework/php-view-language-api/tests/views/footer.html -->
</body>
</html>
<!-- VL:END: /home/aherne/work/framework/php-view-language-api/tests/views/footer.html -->

<!-- VL:END: /home/aherne/work/framework/php-view-language-api/tests/views/homepage.html -->
');
    }
}
