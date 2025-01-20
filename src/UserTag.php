<?php

namespace Lucinda\Templating;

/**
 * Defines a generic class to parse all user-defined procedural tags.
 */
class UserTag implements StartTag
{
    private string $filePath;

    /**
     * Constructs parser based on user-defined tag location.
     *
     * @param string $filePath Location of tag procedural file.
     */
    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * Parses start tag.
     *
     * @param  array<string,string> $parameters
     * @return string
     */
    public function parseStartTag(array $parameters=[]): string
    {
        $content= file_get_contents($this->filePath);
        $comment = new TagComment($this->filePath);
        return $comment->start().preg_replace_callback(
            "/[\$]\[([\w\-.]+)\]/",
            function ($match) use ($parameters) {
                return ($parameters[$match[1]] ?? null);
            },
            $content
        ).$comment->end();
    }
}
