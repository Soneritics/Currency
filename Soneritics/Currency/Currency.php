<?php
class Currency
{
    private $sign = '$';
    private $decimalPoint = '.';
    private $thousandsSeparator = ',';
    private $conversionRate = 1;
    private $format = '{sign} {value}';

    public function __construct(
        $sign = null,
        $decimalPoint = null,
        $thousandsSeparator = null,
        $conversionRate = null,
        $format = null
    ) {
        if ($sign !== null) {
            $this->sign = $sign;
        }
        if ($decimalPoint !== null) {
            $this->decimalPoint = $decimalPoint;
        }
        if ($thousandsSeparator !== null) {
            $this->thousandsSeparator = $thousandsSeparator;
        }
        if ($conversionRate !== null) {
            $this->conversionRate = $conversionRate;
        }
        if ($format !== null) {
            $this->format = $format;
        }
    }

    /**
     * @param string $decimalPoint
     * @return $this
     */
    public function setDecimalPoint($decimalPoint)
    {
        $this->decimalPoint = $decimalPoint;
        return $this;
    }

    /**
     * @return string
     */
    public function getDecimalPoint()
    {
        return $this->decimalPoint;
    }

    /**
     * @param string $format
     * @return $this
     */
    public function setFormat($format)
    {
        $this->format = $format;
        return $this;
    }

    /**
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @param string $sign
     * @return $this
     */
    public function setSign($sign)
    {
        $this->sign = $sign;
        return $this;
    }

    /**
     * @return string
     */
    public function getSign()
    {
        return $this->sign;
    }

    /**
     * @param int $conversionRate
     * @return $this
     */
    public function setConversionRate($conversionRate)
    {
        $this->conversionRate = $conversionRate;
        return $this;
    }

    /**
     * @return int
     */
    public function getConversionRate()
    {
        return $this->conversionRate;
    }

    /**
     * @param string $thousandsSeparator
     * @return $this
     */
    public function setThousandsSeparator($thousandsSeparator)
    {
        $this->thousandsSeparator = $thousandsSeparator;
        return $this;
    }

    /**
     * @return string
     */
    public function getThousandsSeparator()
    {
        return $this->thousandsSeparator;
    }
}