<?php

declare(strict_types=1);

namespace Codamos\Tagger\Scanner;

use Codamos\Tagger\Model\PropertyTagMap;
use InvalidArgumentException;

interface ScannerInterface
{
    /**
     * @param class-string $className
     * @throws InvalidArgumentException
     */
    public function scan(string $className): PropertyTagMap;
}
