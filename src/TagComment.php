<?php

namespace Lucinda\Templating;

/**
 * Envelops templates/tags with start/end comments for later debugging
 */
class TagComment
{
    private string $filePath;

    /**
     * @param string $filePath
     */
    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * Generates a start comment
     *
     * @return string
     */
    public function start(): string
    {
        return "<!-- VL:START: ".$this->filePath." -->\n";
    }

    /**
     * Generates an end comment
     *
     * @return string
     */
    public function end(): string
    {
        return "\n<!-- VL:END: ".$this->filePath." -->\n";
    }
}