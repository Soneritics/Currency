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

/**
 * Unit testing for the Currency object.
 *
 * @author Jordi Jolink
 * @since 18-2-2015
 */
class CurrencyTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test the Currency's constructor.
     */
    public function testConstructor()
    {
        $sign = '$';
        $decimalSeparator = '.';
        $thousandsSeparator = ',';
        $conversionRate = 1.5;
        $format = '{value}{sign}';

        $currency = new Currency\Currency(
            $sign,
            $decimalSeparator,
            $thousandsSeparator,
            $conversionRate,
            $format
        );

        $this->assertEquals($sign, $currency->getSign());
        $this->assertEquals($decimalSeparator, $currency->getDecimalPoint());
        $this->assertEquals($thousandsSeparator, $currency->getThousandsSeparator());
        $this->assertEquals($conversionRate, $currency->getConversionRate());
        $this->assertEquals($format, $currency->getFormat());
    }

    /**
     * Test the decimal point getter/setter.
     */
    public function testDecimalPointGetSet()
    {
        $currency = new Currency\Currency;
        $tests = ['.', ','];
        foreach ($tests as $separator) {
            $currency->setDecimalPoint($separator);
            $this->assertEquals($separator, $currency->getDecimalPoint());
        }
    }

    /**
     * Test the thousands separator getter/setter.
     */
    public function testThousandsSeparatorGetSet()
    {
        $currency = new Currency\Currency;
        $tests = ['.', ','];
        foreach ($tests as $separator) {
            $currency->setThousandsSeparator($separator);
            $this->assertEquals($separator, $currency->getThousandsSeparator());
        }
    }

    /**
     * Test the sign getter/setter.
     */
    public function testSignGetSet()
    {
        $currency = new Currency\Currency;
        $tests = ['$', '€'];
        foreach ($tests as $sign) {
            $currency->setSign($sign);
            $this->assertEquals($sign, $currency->getSign());
        }
    }

    /**
     * Test the format getter/setter.
     */
    public function testFormatGetSet()
    {
        $currency = new Currency\Currency;
        $tests = ['{sign} {value}', '{value} {sign}'];
        foreach ($tests as $format) {
            $currency->setFormat($format);
            $this->assertEquals($format, $currency->getFormat());
        }
    }

    /**
     * Test the conversion rate getter/setter.
     */
    public function testConversionRateGetSet()
    {
        $currency = new Currency\Currency;
        $tests = [1.5, 1, 2, 2.39876, 1.23489];
        foreach ($tests as $conversion) {
            $currency->setConversionRate($conversion);
            $this->assertEquals($conversion, $currency->getConversionRate());
        }
    }

    /**
     * Test for a wrong conversion rate.
     * @expectedException Exception
     */
    public function testConversionRateException()
    {
        $this->setExpectedException('\Exception');
        (new Currency\Currency)->setConversionRate('fail');
    }
}
