<?php

declare(strict_types=1);

namespace Codamos\Tagger\Tests\Scanner\fixtures;

use Codamos\Tagger\Attributes\Tag;

class UserFixture
{
    #[Tag('json:"id" orm:"id,primaryKey,autoincrement"')]
    public string $id;

    #[Tag('json:"name" orm:"name,required,size:255"')]
    public string $name;

    #[Tag('json:"email" orm:"email,required,unique,index,size:255"')]
    #[FakeAttribute]
    public string $email;
}
