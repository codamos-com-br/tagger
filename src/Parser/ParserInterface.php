<?php

declare(strict_types=1);

namespace Codamos\Tagger\Parser;

use Codamos\Tagger\Model\TagMap;

interface ParserInterface
{
    public function parse(string $tagContents): TagMap;
}
