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
 * Price object. Displays prices in their correct format.
 * @author Jordi Jolink <mail@jordijolink.nl>
 * @since  18-2-2015
 */
class Price
{
    /**
     * A list of Currency objects, with the key of the array being the name
     * of the currency.
     * @var array
     */
    private $currencies = [];

    /**
     *Name of the actve currency.
     * @var string
     */
    private $activeCurrency;

    /**
     * Add a currency object to the available currencies list.
     * @param string $name
     * @param \Currency\Currency $currency
     * @return $this
     */
    public function addCurrency($name, Currency $currency)
    {
        if (empty($this->currencies)) {
            $this->activeCurrency = $name;
        }

        $this->currencies[$name] = $currency;
        return $this;
    }

    /**
     * Set the active currency for displaying.
     * @param string $name
     * @return $this
     */
    public function setActiveCurrency($name)
    {
        $this->checkCurrencyExistence($name);
        $this->activeCurrency = $name;
        return $this;
    }

    /**
     * Get the name of the active currency.
     * @return string
     */
    public function getActiveCurrency()
    {
        return $this->activeCurrency;
    }

    /**
     * Convert one currency into another.
     * @param double $value
     * @param string $from
     * @param string $to
     * @return double
     */
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

    /**
     * Show the price, based on the format of a chosen Currency.
     * @param double $value
     * @param string $valueCurrencyName
     * @param string $showCurrencyName
     * @return string
     */
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

        $currencyTo = $this->currencies[$valueCurrencyName];

        $resultFormatted = number_format(
            $resultRounded,
            2,
            $currencyTo->getDecimalPoint(),
            $currencyTo->getThousandsSeparator()
        );

        return strtr(
            $currencyTo->getFormat(),
            [
                '{sign}' => $currencyTo->getSign(),
                '{value}' => $resultFormatted
            ]
        );
    }

    /**
     * Check if a currency with a given name exists in the list.
     * @param string $name
     * @throws \Exception
     */
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
