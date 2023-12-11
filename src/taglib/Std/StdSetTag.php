<?php
namespace Lucinda\Templating;

/**
 * Implements how setting an internal variable is translated into a tag.
 *
 * Tag syntax:
 * <:set var="VARNAME" val="EXPRESSION"/>
 */
class StdSetTag extends SystemTag implements StartTag
{
    /**
     * {@inheritDoc}
     * @see StartTag::parseStartTag()
     */
    public function parseStartTag($parameters=array())
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
     * @param $expression
     * @return bool
     */
    protected function isFunction($expression)
    {
        return (bool) preg_match("/^[a-zA-Z0-9_'\"]+\s*\(([^\)]+)\)$/", $expression);
    }
}
