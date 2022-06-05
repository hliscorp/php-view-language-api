<?php

namespace Lucinda\Templating;

/**
 * Parses system tags and appends them to compilation
 */
class SystemTagParser
{
    private AttributesParser $attributesParser;

    /**
     * Constructor instancing attributes parser
     */
    public function __construct()
    {
        $this->attributesParser = new AttributesParser();
    }

    /**
     * Looks for tags in views and returns an answer where each found match is converted to PHP.
     *
     * @param  string $subject
     * @return string
     * @throws ViewException
     */
    public function parse(string $subject): string
    {
        // match start & end tags
        $subject = preg_replace_callback(
            "/<:([a-z]+)(\s*(.*)\s*=\s*\"(.*)\"\s*)?\/?>/",
            function ($matches) {
                $parameters = isset($matches[2]) ? $this->attributesParser->parse($matches[2]) : [];
                return $this->getTagInstance($matches)->parseStartTag($parameters);
            },
            $subject
        );
        return preg_replace_callback(
            "/<\/:([a-z]+)>/",
            function ($matches) {
                return $this->getTagInstance($matches)->parseEndTag();
            },
            $subject
        );
    }

    /**
     * Detects tag class from tag declaration.
     *
     * @param  array<int,string> $matches
     * @return StartTag|StartEndTag
     */
    private function getTagInstance(array $matches): StartTag|StartEndTag
    {
        $className = __NAMESPACE__."\\TagLib\\Std\\".ucwords($matches[1])."Tag";
        return new $className();
    }
}
