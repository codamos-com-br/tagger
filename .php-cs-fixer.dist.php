<?php

declare(strict_types=1);

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$finder = (new Finder())
    ->in(__DIR__)
    ->exclude([
        'vendor/',
    ])
;

return (new Config())
    ->setRules([
        '@PER-CS' => true,
        'array_syntax' => ['syntax' => 'short'],
    ])
    ->setFinder($finder)
    ->setIndent('    ')
    ->setLineEnding("\n")
;