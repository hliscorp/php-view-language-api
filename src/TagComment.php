<?php

namespace Lucinda\Templating;

/**
 * Envelops templates/tags with start/end comments for later debugging
 */
class TagComment
{
    private $filePath;

    /**
     * @param $filePath
     */
    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * Generates a start comment
     *
     * @return string
     */
    public function start()
    {
        return "<!-- VL:START: ".$this->filePath." -->\n";
    }

    /**
     * Generates an end comment
     *
     * @return string
     */
    public function end()
    {
        return "\n<!-- VL:END: ".$this->filePath." -->\n";
    }
}