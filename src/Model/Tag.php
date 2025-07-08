<?php

declare(strict_types=1);

namespace Codamos\Tagger\Model;

final class Tag
{
    public function __construct(
        public readonly string $name,
        public readonly string $value,
    ) {}
}
