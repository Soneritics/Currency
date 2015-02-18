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
namespace Currency;

/**
 * Currency object that represents a single currency, like usd or euro.
 * @author Jordi Jolink <mail@jordijolink.nl>
 * @since  18-2-2015
 */
class Currency
{
    /**
     * Currency sign.
     * @var string
     */
    private $sign = '$';

    /**
     * Decimal separator.
     * @var string
     */
    private $decimalPoint = '.';

    /**
     * Thousands separator.
     * @var string
     */
    private $thousandsSeparator = ',';

    /**
     * Conversion rate with respect to the base currency, which has a
     * conversion rate of 1.
     * @var double
     */
    private $conversionRate = 1;

    /**
     * Display format for the currency.
     * @var string
     */
    private $format = '{sign} {value}';

    /**
     * Create the Currency object with predefined values.
     * @param string $sign
     * @param string $decimalPoint
     * @param string $thousandsSeparator
     * @param double $conversionRate
     * @param string $format
     */
    public function __construct(
        $sign = null,
        $decimalPoint = null,
        $thousandsSeparator = null,
        $conversionRate = null,
        $format = null
    ) {
        if ($sign !== null) {
            $this->setSign($sign);
        }
        if ($decimalPoint !== null) {
            $this->setDecimalPoint($decimalPoint);
        }
        if ($thousandsSeparator !== null) {
            $this->setThousandsSeparator($thousandsSeparator);
        }
        if ($conversionRate !== null) {
            $this->setConversionRate($conversionRate);
        }
        if ($format !== null) {
            $this->setFormat($format);
        }
    }

    /**
     * Set the decimal separator.
     * @param string $decimalPoint
     * @return $this
     */
    public function setDecimalPoint($decimalPoint)
    {
        $this->decimalPoint = $decimalPoint;
        return $this;
    }

    /**
     * Get the decimal separator.
     * @return string
     */
    public function getDecimalPoint()
    {
        return $this->decimalPoint;
    }

    /**
     * Set the display format.
     * @param string $format
     * @return $this
     */
    public function setFormat($format)
    {
        $this->format = $format;
        return $this;
    }

    /**
     * Get the display format.
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * Set the currency sign.
     * @param string $sign
     * @return $this
     */
    public function setSign($sign)
    {
        $this->sign = $sign;
        return $this;
    }

    /**
     * Get the currency sign.
     * @return string
     */
    public function getSign()
    {
        return $this->sign;
    }

    /**
     * Set the conversion rate with respect to the base currency.
     * @param double $conversionRate
     * @return $this
     */
    public function setConversionRate($conversionRate)
    {
        if (!is_numeric($conversionRate)) {
            throw new \Exception(
                "Conversion rate {$conversionRate} is not a number."
            );
        }

        $this->conversionRate = $conversionRate;
        return $this;
    }

    /**
     * Return the conversion rate.
     * @return double
     */
    public function getConversionRate()
    {
        return $this->conversionRate;
    }

    /**
     * Set the thousands separator.
     * @param string $thousandsSeparator
     * @return $this
     */
    public function setThousandsSeparator($thousandsSeparator)
    {
        $this->thousandsSeparator = $thousandsSeparator;
        return $this;
    }

    /**
     * Get the thousands separator.
     * @return string
     */
    public function getThousandsSeparator()
    {
        return $this->thousandsSeparator;
    }
}
