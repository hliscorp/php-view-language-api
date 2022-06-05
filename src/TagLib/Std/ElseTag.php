<?php

namespace Lucinda\Templating\TagLib\Std;

use Lucinda\Templating\StartTag;
use Lucinda\Templating\SystemTag;

/**
 * Implements how an ELSE clause is translated into a tag.
 *
 * Tag syntax:
 * <:else>BODY
 */
class ElseTag extends SystemTag implements StartTag
{
    /**
     * Parses start tag.
     *
     * @param  array<string,string> $parameters
     * @return string
     */
    public function parseStartTag(array $parameters=[]): string
    {
        return '<?php } else { ?>';
    }
}
