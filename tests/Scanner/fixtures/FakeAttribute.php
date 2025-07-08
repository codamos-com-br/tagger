<?php

declare(strict_types=1);

namespace Codamos\Tagger\Tests\Scanner\fixtures;

use Attribute;

#[Attribute(flags: Attribute::TARGET_PROPERTY)]
final class FakeAttribute {}
