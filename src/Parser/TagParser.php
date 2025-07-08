<?php

declare(strict_types=1);

namespace Codamos\Tagger\Parser;

use Codamos\Tagger\Model\Tag;
use Codamos\Tagger\Model\TagMap;

final class TagParser implements ParserInterface
{
    public function parse(string $tagContents): TagMap
    {
        $tags = [];

        $isValue = false;
        $withinQuotes = false;
        $tagName = '';
        $tagValue = '';
        for ($i = 0; $i < mb_strlen($tagContents); $i++) {
            $char = mb_substr($tagContents, $i, 1);

            if ($char === ':' && !$isValue) {
                $isValue = true;
                continue;
            }

            if ($char === '"' && $isValue) {
                if ($withinQuotes) {
                    $tag = new Tag(
                        name: mb_trim($tagName),
                        value: mb_trim($tagValue),
                    );
                    $tags[] = $tag;

                    $isValue = false;
                    $withinQuotes = false;
                    $tagName = '';
                    $tagValue = '';

                    continue;
                } else {
                    $withinQuotes = true;
                    continue;
                }
            }

            if ($isValue) {
                $tagValue .= $char;
            } else {
                $tagName .= $char;
            }
        }

        $map = [];
        foreach ($tags as $tag) {
            $map[$tag->name] = $tag;
        }
        return new TagMap($map);
    }
}
