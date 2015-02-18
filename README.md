# Currency #

[![Build Status](https://api.travis-ci.org/Soneritics/Currency.svg?branch=master)](https://travis-ci.org/Soneritics/Currency)
![License](http://img.shields.io/badge/license-MIT-green.svg)

by
* [@Soneritics](https://github.com/Soneritics) - Jordi Jolink


## Introduction ##
Currency converting and showing a formatted price label.

## Minimum Requirements ##

- PHP 5.5+

## Features ##

- Showing a formatted price; $ 1.99 or € 1,99
- Converting currencies

### Example ###

```php
$price = (new Price)
    ->addCurrency('euro', new Currency('€', ',', '.'));
    ->addCurrency('dollar', new Currency('$', '.', ',', 1.1388));

echo $price->show(1) . '<br>'; // € 1,00
echo $price->show(1, 'euro', 'dollar') . '<br>';
echo $price->show(1, 'dollar', 'euro') . '<br>';
```
