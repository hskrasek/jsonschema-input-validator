# OpenAPI Schema to JSON Schema Converter

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

This package provides a wrapper around [JSON Guard](https://github.com/thephpleague/json-guard), allowing you to get a ProblemDetails object representing any errors with the data being validated.

## Install

Via Composer

``` bash
$ composer require hskrasek/jsonschema-input-validator
```

## Usage

``` php
<?php

use HSkrasek\JSONSchema\Validator;

$validator = new Validator($data, $schema);

if ($validator->fails()) {
    $problemDetails = $validator->getProblemDetails();
    
    // Render problem details somehow
    return json_encode($problemDetails);
}
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for details.

## Security

If you discover any security related issues, please email hunterskrasek@me.com instead of using the issue tracker.

## Credits

- [Hunter Skrasek][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/hskrasek/jsonschema-input-validator.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/hskrasek/jsonschema-input-validator/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/hskrasek/jsonschema-input-validator.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/hskrasek/jsonschema-input-validator.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/hskrasek/jsonschema-input-validator.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/hskrasek/jsonschema-input-validator
[link-travis]: https://travis-ci.org/hskrasek/jsonschema-input-validator
[link-scrutinizer]: https://scrutinizer-ci.com/g/hskrasek/jsonschema-input-validator/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/hskrasek/jsonschema-input-validator
[link-downloads]: https://packagist.org/packages/hskrasek/jsonschema-input-validator
[link-author]: https://github.com/hskrasek
[link-contributors]: ../../contributors
