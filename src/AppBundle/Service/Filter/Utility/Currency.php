<?php
// src/AppBundle/Service/Filter/Utility/Currency.php
namespace AppBundle\Service\Filter\Utility;

use Symfony\Component\HttpFoundation\Session\Session;

class Currency
{
    const CURRENCY = 'filter_currency';

    const CURRENCY_CODE_UAH = 'UAH';
    const CURRENCY_CODE_USD = 'USD';

    private $_session;

    public function setSession(Session $session)
    {
        $this->_session = $session;
    }

    static public function getCurrencyCodes()
    {
        return [self::CURRENCY_CODE_UAH, self::CURRENCY_CODE_USD];
    }

    public function setCurrency($currencyCode)
    {
        if( !in_array($currencyCode, self::getCurrencyCodes(), TRUE) )
            $currencyCode = self::getDefaultCurrency();

        $this->_session->set(self::CURRENCY, $currencyCode);
    }

    public function removeCurrency()
    {
        if( $this->_session->has(self::CURRENCY) )
            $this->_session->remove(self::CURRENCY);
    }

    public function getCurrency()
    {
        return ( $this->_session->has(self::CURRENCY) )
                ? $this->_session->get(self::CURRENCY)
                : NULL;
    }

    public function setDefaultCurrency()
    {
        $this->_session->set(self::CURRENCY, self::getDefaultCurrency());
    }

    static public function getDefaultCurrency()
    {
        return self::CURRENCY_CODE_USD;
    }
}
