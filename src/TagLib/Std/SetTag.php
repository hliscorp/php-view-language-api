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
     * @param  array<string,string> $parameters
     * @return string
     * @throws \Lucinda\Templating\ViewException
     */
    public function parseStartTag(array $parameters=[]): string
    {
        $this->checkParameters($parameters, array("var"));
        $output = '<?php $'.$parameters['var'].' = ';
        if (isset($parameters["val"])) {
            if ($this->isExpression($parameters['val'])) {
                $output .= $this->parseExpression($parameters['val']);
            } else if ($this->isFunction($parameters['val'])) {
                $output .= $parameters['val'];
            } else {
                $output .= "'".addslashes($parameters['val'])."'";
            }
        } else {
            $output .= "null";
        }
        return $output.'; ?>';
    }

    /**
     * Checks if variable value is a function without expressions
     * 
     * @param string $expression
     * @return bool
     */
    protected function isFunction($expression): bool
    {
        return (bool) preg_match("/^[a-zA-Z0-9_'\"]+\s*\(([^\)]+)\)$/", $expression);
    }
}
