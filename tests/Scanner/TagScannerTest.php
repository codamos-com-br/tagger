<?php

declare(strict_types=1);

namespace Codamos\Tagger\Tests\Scanner;

use Codamos\Tagger\Model\Tag;
use Codamos\Tagger\Parser\TagParser;
use Codamos\Tagger\Scanner\TagScanner;
use Codamos\Tagger\Tests\Scanner\fixtures\UserFixture;
use PHPUnit\Framework\TestCase;

final class TagScannerTest extends TestCase
{
    public function test_parse(): void
    {
        $parser = new TagParser();
        $scanner = new TagScanner($parser);
        $tags = $scanner->scan(UserFixture::class);

        // #[Tag('json:"id" orm:"id,primaryKey,autoincrement"')]
        $id = $tags->get('id');
        self::assertTrue($id?->containsKey('json'));
        self::assertEquals(new Tag('json', 'id'), $id->get('json'));
        self::assertTrue($id->containsKey('orm'));
        self::assertEquals(new Tag('orm', 'id,primaryKey,autoincrement'), $id->get('orm'));

        // #[Tag('json:"name" orm:"name,required,size:255"')]
        $name = $tags->get(key: 'name');
        self::assertTrue($name?->containsKey('json'));
        self::assertEquals(new Tag('json', 'name'), $name->get('json'));
        self::assertTrue($name->containsKey('orm'));
        self::assertEquals(new Tag('orm', 'name,required,size:255'), $name->get('orm'));

        // #[Tag('json:"email" orm:"email,required,unique,index,size:255"')]
        $email = $tags->get(key: 'email');
        self::assertTrue($email?->containsKey('json'));
        self::assertEquals(new Tag('json', 'email'), $email->get('json'));
        self::assertTrue($email->containsKey('orm'));
        self::assertEquals(new Tag('orm', 'email,required,unique,index,size:255'), $email->get('orm'));
    }
}
