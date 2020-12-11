[![Build Status](https://travis-ci.org/slepic/php-template.svg?branch=master)](https://travis-ci.org/slepic/php-template)
[![Style Status](https://styleci.io/repos/183834781/shield)](https://styleci.io/repos/183834781)

# php-template
Template rendering abstraction library. Abstract your libraries from specific templating engines.

## Requirements

PHP 7.4 or 8

## Installation

Install with composer

```composer require slepic/php-template```

## Interfaces

### [```TemplateInterface```](https://github.com/slepic/php-template/blob/master/src/TemplateInterface.php)
This is the abstraction of any data rendering template.

## Classes

### [```OutputBufferTemplate```](https://github.com/slepic/php-template/blob/master/src/OutputBufferTemplate.php)
A simple template implementation, which renders the data using another PHP script (given its filename) and PHP ob_* functions.

### [```DefaultDataTemplate```](https://github.com/slepic/php-template/blob/master/src/DefaultDataTemplate.php)
Template decorator which allows to feed your templates with default data hidden from the template consumer.

## Contribution

If you create a library that depends on this one and you use composer, please consider the following:
* If you implement the ```TemplateInterface```, please place [```slepic/php-template-implementation```](https://packagist.org/providers/slepic/php-template-implementation) in the provide section of your ```composer.json```.
* If you consume the ```TemplateInterface```, please place [```slepic/php-template-consumer```](https://packagist.org/providers/slepic/php-template-consumer) in the provide section of your ```composer.json```.

## Changelog

### 1.1.0
* added new class `DefaultDataTemplate`
* `OutputBufferTemplate` now ends the output buffer if the included template throws an exception.
* `OutputBufferTemplate` now uses `include` instead of `require` to execute the template script .

### 1.0.0

* bump PHP to ^7.4 || ^8.0
* TemplateInterface::render() now has string return typehint
* OutputBufferTemplate::render throws InvalidArgumentException if data argument contains keys that cannot be used as local variable names
* use squizlabs/php_codesniffer instead of friendsofphp/php-cs-fixer for style check
* bump dev deps to latest versions
* use composer docker image for dev
* move composer scripts to makefile

### 0.2.0

* Added array typehint for first argument of ```TemplateInterface::render()```.
* Changed travis setup to only run tests in oldest and newest php versions supported by this package (that is 5.6 and 7.3).
