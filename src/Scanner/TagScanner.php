<?php

declare(strict_types=1);

namespace Codamos\Tagger\Scanner;

use Codamos\Tagger\Attributes\Tag;
use Codamos\Tagger\Model\PropertyTagMap;
use Codamos\Tagger\Model\TagMap;
use Codamos\Tagger\Parser\ParserInterface;
use InvalidArgumentException;
use ReflectionClass;

final class TagScanner
{
    public function __construct(
        private readonly ParserInterface $parser,
    ) {}

    /**
     * @param class-string $className
     * @throws InvalidArgumentException
     */
    public function scan(string $className): PropertyTagMap
    {
        if (!class_exists($className)) {
            throw new InvalidArgumentException(
                sprintf('class "%s" does not exist.', $className),
            );
        }

        $map = new PropertyTagMap();

        $propRefs = (new ReflectionClass($className))->getProperties();
        foreach ($propRefs as $propRef) {
            $attrRefs = $propRef->getAttributes();
            foreach ($attrRefs as $attrRef) {
                if (
                    $attrRef->getName() !== Tag::class
                ) {
                    continue;
                }

                /** @var Tag $inst */
                $inst = $attrRef->newInstance();
                $tagContents = $inst->tagContents;
                $tags = $this->parser->parse($tagContents);
                if ($map->containsKey($propRef->getName())) {
                    foreach ($tags as $tag) {
                        $property = $map->get($propRef->getName());
                        if ($property instanceof TagMap) {
                            $property->put($tag->name, $tag);
                        }
                    }
                } else {
                    $map->put($propRef->getName(), $tags);
                }
            }
        }

        return $map;
    }
}
