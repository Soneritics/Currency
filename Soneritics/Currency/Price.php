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
 * 
 * @author Jordi Jolink <mail@jordijolink.nl>
 * @since  18-2-2015
 */
class Price
{
    private $currencies = array();
    private $activeCurrency;

    public function addCurrency($name, Currency $currency)
    {
        if (empty($this->currencies)) {
            $this->activeCurrency = $name;
        }

        $this->currencies[$name] = $currency;
        return $this;
    }

    public function setCurrency($name)
    {
        $this->checkCurrencyExistence($name);
        $this->activeCurrency = $name;
        return $this;
    }

    public function getActiveCurrency()
    {
        return $this->activeCurrency;
    }

    public function convert($value, $from, $to)
    {
        $this->checkCurrencyExistence($from);
        $this->checkCurrencyExistence($to);

        $currencyFrom = $this->currencies[$from];
        $currencyTo = $this->currencies[$to];

        return
            ($value / $currencyFrom->getConversionRate()) *
            $currencyTo->getConversionRate();
    }

    public function show(
        $value,
        $valueCurrencyName = null,
        $showCurrencyName = null
    ) {
        if ($valueCurrencyName === null) {
            $valueCurrencyName = $this->activeCurrency;
        }

        if ($showCurrencyName === null) {
            $showCurrencyName = $this->activeCurrency;
        }

        $resultRounded = round(
            $this->convert($value, $valueCurrencyName, $showCurrencyName),
            2
        );

        $resultFormatted = number_format(
            $resultRounded,
            2,
            $currencyTo->getDecimalPoint(),
            $currencyTo->getThousandsSeparator()
        );

        return strtr(
            $currencyTo->getFormat(),
            array(
                '{sign}' => $currencyTo->getSign(),
                '{value}' => $resultFormatted
            )
        );
    }

    private function checkCurrencyExistence($name)
    {
        if (!isset($this->currencies[$name])) {
            throw new \Exception(
                sprintf(
                    'Currency %s is unknown. Use addCurrency to add first.',
                    $name
                )
            );
        }
    }
}