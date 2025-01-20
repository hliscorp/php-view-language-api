<?php
namespace Test\Lucinda\Templating;
    
use Lucinda\Templating\TagComment;
use Lucinda\UnitTest\Result;

class TagCommentTest
{

    public function start()
    {
        $comment = new TagComment("asd");
        return new Result($comment->start()=="<!-- VL:START: asd -->\n");
    }
        

    public function end()
    {
        $comment = new TagComment("asd");
        return new Result($comment->end()=="\n<!-- VL:END: asd -->\n");
    }
        

}
