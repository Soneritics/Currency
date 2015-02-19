<?php
/* 
 * The MIT License
 *
 * Copyright 2014 Soneritics Webdevelopment.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

require_once __DIR__ . '/../Soneritics/Currency/Currency.php';
require_once __DIR__ . '/../Soneritics/Currency/Price.php';

/**
 * Unit testing for the Price object.
 *
 * @author Jordi Jolink
 * @since 18-2-2015
 */
class PriceTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test if a currency can be added.
     */
    public function testAddCurrency()
    {
        $price = (new Currency\Price)
            ->addCurrency('euro', new Currency\Currency('€'));

        $this->assertEquals('euro', $price->getActiveCurrency());
    }

    /**
     * Test the convert function of the PRice object.
     */
    public function testConvert()
    {
        $price = (new Currency\Price)
            ->addCurrency('euro', new Currency\Currency('€'))
            ->addCurrency('usd', new Currency\Currency('$', null, null, 1.2));

        $this->assertEquals($price->convert(1, 'euro', 'usd'), 1.2);
        $this->assertNotEquals($price->convert(1, 'euro', 'usd'), 1.5);
    }

    /**
     * Test for a wrong conversion rate.
     * @expectedException Exception
     */
    public function testConvertException()
    {
        $price = (new Currency\Price)
            ->addCurrency('euro', new Currency\Currency('€'));

        $this->setExpectedException('\Exception');
        $price->convert(1, 'euro', 'not-existing');
    }

    /**
     * Test the show function.
     */
    public function testShow()
    {
        $price = (new Currency\Price)
            ->addCurrency('euro', new Currency\Currency('€', ',', '.', 1, '{sign} {value}'))
            ->addCurrency('usd', new Currency\Currency('$', '.', ',', 1.2, '{sign}{value}'));

        $this->assertEquals($price->show(1), '€ 1,00');
        $this->assertEquals($price->show('1'), '€ 1,00');
        $this->assertEquals($price->show('1.5'), '€ 1,50');
        $this->assertEquals($price->show(1, 'euro', 'usd'), '€ 1,20');
        $this->assertEquals($price->show(1, 'usd'), '$0.83');
    }

    /**
     * Test the setter for currency.
     */
    public function testCurrencySetter()
    {
        $price = (new Currency\Price)
            ->addCurrency('euro', new Currency\Currency)
            ->addCurrency('usd', new Currency\Currency);

        $this->assertEquals('euro', $price->getActiveCurrency());
        $price->setActiveCurrency('usd');
        $this->assertEquals('usd', $price->getActiveCurrency());
    }
}
