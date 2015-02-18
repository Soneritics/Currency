<?php
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

        $this->checkCurrencyExistence($valueCurrencyName);
        $this->checkCurrencyExistence($showCurrencyName);

        $currencyFrom = $this->currencies[$valueCurrencyName];
        $currencyTo = $this->currencies[$showCurrencyName];

        $resultUnformatted =
            ($value / $currencyFrom->getConversionRate()) *
            $currencyTo->getConversionRate();

        $resultRounded = round($resultUnformatted, 2);
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