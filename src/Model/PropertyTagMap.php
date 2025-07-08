<?php

declare(strict_types=1);

namespace Codamos\Tagger\Model;

use Ramsey\Collection\Map\AbstractTypedMap;

/**
 * @extends AbstractTypedMap<string, TagMap>
 */
final class PropertyTagMap extends AbstractTypedMap
{
    public function getKeyType(): string
    {
        return 'string';
    }

    public function getValueType(): string
    {
        return TagMap::class;
    }
}
