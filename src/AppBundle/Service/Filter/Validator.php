<?php
// src/AppBundle/Service/Filter/Validator.php
namespace AppBundle\Service\Filter;

use Symfony\Component\HttpFoundation\Request;

use AppBundle\Service\Filter\Utility\Interfaces\FilterArgumentsInterface,
    AppBundle\Entity\Estate;

class Validator implements FilterArgumentsInterface
{
    private $_availableValuesExtractor;

    public function setAvailableValuesExtractor(AvailableValuesExtractor $availableValuesExtractor)
    {
        $this->_availableValuesExtractor = $availableValuesExtractor;
    }

    public function validateArguments(array $filterArguments, array $estates, $currency)
    {
        if( !empty($filterArguments[self::FILTER_DISTRICTS]) )
        {
            if( !$this->validateDistricts($filterArguments[self::FILTER_DISTRICTS]) )
                return FALSE;
        }

        if( !empty($filterArguments[self::FILTER_ESTATE_TYPE]) )
        {
            if( !$this->validateEstateType($filterArguments[self::FILTER_ESTATE_TYPE], $estates) )
                return FALSE;
        }

        if( !empty($filterArguments[self::FILTER_TRADE_TYPE]) )
        {
            if( !$this->validateTradeType($filterArguments[self::FILTER_TRADE_TYPE], $estates) )
                return FALSE;
        }

        // if( !empty($filterArguments[self::FILTER_CURRENCY]) )
        // {
        //     if( !$this->validateCurrency($filterArguments[self::FILTER_CURRENCY]) )
        //         return FALSE;
        // }

        if( !empty($filterArguments[self::FILTER_PRICE]) )
        {
            $filterArguments[self::FILTER_PRICE] = $this->sanitizePriceRange($filterArguments[self::FILTER_PRICE], $estates, $currency);
        }

        if( !empty($filterArguments[self::FILTER_SPACE]) )
        {
            $filterArguments[self::FILTER_SPACE] = $this->sanitizeSpaceRange($filterArguments[self::FILTER_SPACE], $estates);
        }

        return $filterArguments;
    }

    protected function validateEstateType($estateType, $estates)
    {
        $existingEstateTypes = $this->_availableValuesExtractor->availableEstateTypes($estates, $flatValues = TRUE);

        if( !in_array($estateType, $existingEstateTypes, TRUE) )
            return FALSE;

        return TRUE;
    }

    protected function validateTradeType($tradeType, $estates)
    {
        $existingTradeTypes = $this->_availableValuesExtractor->availableTradeTypes($estates);

        if( !in_array($tradeType, $existingTradeTypes, TRUE) )
            return FALSE;

        return TRUE;
    }

    protected function validateCurrency($currency)
    {
        $existingCurrencies = $this->_availableValuesExtractor->availableCurrencies();

        if( !in_array($currency, $existingCurrencies, TRUE) )
            return FALSE;

        return TRUE;
    }

    public function sanitizePriceRange($priceRange, $estates, $currency)
    {
        $existingPriceRange = $this->_availableValuesExtractor->availablePriceRange($estates, $currency);

        $notValid = function($value) {
            return ( empty($value) || !is_numeric($value) || ($value < 0) );
        };

        if( $notValid($priceRange['min']) )
            $priceRange['min'] = $existingPriceRange['min'];

        if( $notValid($priceRange['max']) )
            $priceRange['max'] = $existingPriceRange['max'];

        return $priceRange;
    }

    public function sanitizeSpaceRange($spaceRange, $estates)
    {
        $existingSpaceRange = $this->_availableValuesExtractor->availableSpaceRange($estates);

        $notValid = function($value) {
            return ( empty($value) || !is_numeric($value) || ($value < 0) );
        };

        if( $notValid($spaceRange['min']) )
            $spaceRange['min'] = $existingSpaceRange['min'];

        if( $notValid($spaceRange['max']) )
            $spaceRange['max'] = $existingSpaceRange['max'];

        return $spaceRange;
    }

    protected function validateDistricts(array $districts)
    {
        $existingDistricts = array_keys(Estate::getDistricts());

        foreach($districts as $district)
        {
            if( !in_array($district, $existingDistricts, TRUE) )
                return FALSE;
        }

        return TRUE;
    }
}
