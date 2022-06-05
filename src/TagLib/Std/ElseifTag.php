<?php

namespace Lucinda\Templating\TagLib\Std;

use Lucinda\Templating\StartTag;
use Lucinda\Templating\SystemTag;

/**
 * Implements how an ELSE IF clause is translated into a tag.
 *
 * Tag syntax:
 * <:elseif test="EXPRESSION">BODY
 */
class ElseifTag extends SystemTag implements StartTag
{
    /**
     * Parses start tag.
     *
     * @param  array<string,string> $parameters
     * @return string
     * @throws \Lucinda\Templating\ViewException
     */
    public function parseStartTag(array $parameters=[]): string
    {
        $this->checkParameters($parameters, array("test"));
        return '<?php } else if ('.$this->parseExpression($parameters['test']).') { ?>';
    }
}
