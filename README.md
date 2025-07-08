<h1 align="center">codamos/tagger</h1>

<p align="center">
    <strong> A simple tagging library inspired by Go's struct tags</strong>
</p>

<p align="center">
    <a href="https://github.com/codamos-com-br/tagger"><img src="http://img.shields.io/badge/source-codamos-com-br/tagger-blue.svg?style=flat-square" alt="Source Code"></a>
    <a href="https://packagist.org/packages/codamos/tagger"><img src="https://img.shields.io/packagist/v/codamos/tagger.svg?style=flat-square&label=release" alt="Download Package"></a>
    <a href="https://php.net"><img src="https://img.shields.io/packagist/php-v/codamos/tagger.svg?style=flat-square&colorB=%238892BF" alt="PHP Programming Language"></a>
    <a href="https://github.com/codamos-com-br/tagger/blob/main/LICENSE"><img src="https://img.shields.io/packagist/l/codamos/tagger.svg?style=flat-square&colorB=darkcyan" alt="Read License (MIT)"></a>
</p>

## About

`codamos/tagger` is a simple tagging library inspired by Go's [struct tags](https://go.dev/ref/spec#Struct_types).
It allows you to  fetch free-form tags from class properties via a `Tag` attribute that can later be used by third-party
libraries or your own code.

The library also includes a tag parser and a class tags scanner. These should allow you to
use tagger at scale for your entire application at build time, or at runtime.

## Installation

Install this package as a dependency using [Composer](https://getcomposer.org).

``` bash
composer require codamos/tagger
```

## Usage

You may use the `Tag` attribute to annotate your class' properties with free-form tags, split by space characters.

```php
use Codamos\Tagger\Attributes\Tag;
use Codamos\Tagger\Parser\TagParser;
use Codamos\Tagger\Scanner\TagScanner;

class UserDTO
{
    #[Tag('json:"id" orm:"id,primaryKey,autoIncrement"')]}
    public int $id;

    #[Tag('json:"name" orm:"name,notNull,size:255"')]
    public string $name;

    #[Tag('json:"email" orm:"email,notNull,size:255,unique,index"')]
    public string $email;

$parser = new TagParser();
$scanner = new TagScanner($scanner);

$map = $scanner->scan(UserDTO::class);

$emailTags = $map->get('email');
$emailTags->get('json'); // string(json:"email")
$emailTags->get('orm'); // string(orm:"email,notNull,size:255,unique,index")
```

## Copyright and License

The codamos/tagger library is copyright © [Codamos](https://codamos.com.br)
and licensed for use under the terms of the
MIT License (MIT). Please see [LICENSE](LICENSE) for more information.
