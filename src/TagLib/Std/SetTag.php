<?php

namespace Lucinda\Templating\TagLib\Std;

use Lucinda\Templating\SystemTag;
use Lucinda\Templating\StartTag;

/**
 * Implements how setting an internal variable is translated into a tag.
 *
 * Tag syntax:
 * <:set var="VARNAME" val="EXPRESSION"/>
 */
class SetTag extends SystemTag implements StartTag
{
    /**
     * Parses start tag.
     *
     * @param array<string,string> $parameters
     * @return string
     * @throws \Lucinda\Templating\ViewException
     */
    public function parseStartTag(array $parameters=[]): string
    {
        $this->checkParameters($parameters, array("var"));
        $left = '$'.$parameters['var'];
        $right = "null";
        if (isset($parameters['val'])) {
            if ($this->isExpression($parameters['val'])) {
                $right = $this->parseExpression($parameters['val']);
            } else {
                $right = "'".addslashes($parameters['val'])."'";
            }
        }
        return '<?php '.$left.' = '.$right.'; ?>';
    }
}
