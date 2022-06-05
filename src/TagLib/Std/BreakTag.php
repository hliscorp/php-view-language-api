<?php

namespace Lucinda\Templating\TagLib\Std;

use Lucinda\Templating\StartTag;
use Lucinda\Templating\SystemTag;

/**
 * Implements a BREAK operation in a loop.
 *
 * Tag syntax:
 * <:break/>
 */
class BreakTag extends SystemTag implements StartTag
{
    /**
     * Parses start tag.
     *
     * @param  array<string,string> $parameters
     * @return string
     */
    public function parseStartTag(array $parameters=[]): string
    {
        return '<?php break; ?>';
    }
}
