<?php

declare(strict_types=1);

namespace Codamos\Tagger\Attributes;

use Attribute;

#[Attribute(flags: Attribute::TARGET_PROPERTY)]
final class Tag
{
    public function __construct(
        public readonly string $tagContents,
    ) {}
}
