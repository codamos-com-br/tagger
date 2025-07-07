<?php

declare(strict_types=1);

namespace Codamos\Tagger\Attributes;

use Attribute;

#[Attribute(flags: Attribute::TARGET_PROPERTY)]
class Tag {}
