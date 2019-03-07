[This extension is no longer maintained](https://github.com/sebastianbergmann/dbunit/issues/217)

# DbUnit (forked)

[PHPUnit](https://phpunit.de/) extension for database interaction testing.

Forked from [sebastianbergmann/dbunit](https://github.com/sebastianbergmann/dbunit)  
Original README.md is [README_original.md](README_original.md)

I aim to work with phunit-7 and php-7.2

## Installation

### Composer

If you use [Composer](https://getcomposer.org/) to manage the dependencies of your project then you can add DbUnit as a development-time dependency to your project:

Add repository for `composer.json`.
```json
{
    "repositories": [
        { "type": "vcs", "url": "https://github.com/iamapen/dbunit" }
    ]
}
```

```
$ composer require --dev iamapen/dbunit
```
