<?php
// src/AppBundle/Service/CurrencyConverter.php
namespace AppBundle\Service;

class CurrencyConverter
{
    const API_LINK = 'http://bank-ua.com/export/exchange_rate_cash.json';

    const LOOKUP_BANK = "Райффайзен Банк Аваль";

    const CURRENCY_USD = 'USD';
    const CURRENCY_UAH = 'UAH';

    private $conversionCode = NULL;

    private $rates;

    public function __construct()
    {
        $this->rates = file_get_contents(self::API_LINK);
    }

    private function requestRates()
    {
        $rates = $this->rates;

        if( !$rates )
            return FALSE;

        $rates = json_decode($rates);

        foreach ($rates as $rate)
        {
            if( //$rate->bankName == self::LOOKUP_BANK &&
                $rate->codeNumeric === $this->conversionCode )
                return $rate->rateBuy;
        }

        return FALSE;
    }

    public function USD_UAH()
    {
        $this->conversionCode = "840";

        return $this;
    }

    public function convert($amount)
    {
        $rate = $this->requestRates();

        if( !is_numeric($rate) )
            return;

        return bcmul($amount, $rate, 2);
    }
}
