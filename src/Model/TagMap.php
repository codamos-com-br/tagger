<?php

declare(strict_types=1);

namespace Codamos\Tagger\Model;

use Ramsey\Collection\Map\AbstractTypedMap;

/**
 * @extends AbstractTypedMap<string,Tag>
 */
final class TagMap extends AbstractTypedMap
{
    public function getKeyType(): string
    {
        return 'string';
    }

    public function getValueType(): string
    {
        return Tag::class;
    }
}
