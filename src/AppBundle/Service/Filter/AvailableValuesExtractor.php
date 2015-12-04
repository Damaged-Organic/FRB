<?php
// src/AppBundle/Service/Filter/AvailableValuesExtractor.php
namespace AppBundle\Service\Filter;

use AppBundle\Entity\Estate,
    AppBundle\Service\Filter\Utility\Currency;

class AvailableValuesExtractor
{
    public function availableEstateTypes(array $estates, $flatValues = FALSE)
    {
        $availableEstateTypes = [];

        foreach( $estates as $estate )
        {
            if( $estate instanceof Estate )
                $availableEstateTypes[$estate->getEstateType()->getId()] = ( $flatValues ) ? $estate->getEstateType()->getId() : $estate->getEstateType();
        }

        return $availableEstateTypes;
    }

    public function availableTradeTypes(array $estates, $flatValues = FALSE)
    {
        $availableTradeTypes = [];

        $existingTradeTypes = Estate::getTradeTypes();

        foreach( $estates as $estate )
        {
            if( $estate instanceof Estate )
            {
                if( !in_array($estate->getTradeType(), $availableTradeTypes, TRUE) &&
                    !empty($existingTradeTypes[$estate->getTradeType()]) ) {
                    $availableTradeTypes[$estate->getTradeType()] = $existingTradeTypes[$estate->getTradeType()];
                }
            }
        }

        return $availableTradeTypes;
    }

    public function availableCurrencies()
    {
        return Currency::getCurrencyCodes();
    }

    public function availablePriceRange(array $estates, $currency)
    {
        $availablePrices = [];

        foreach( $estates as $estate )
        {
            if( $estate instanceof Estate )
            {
                if( $currency == Currency::CURRENCY_CODE_USD ) {
                    $availablePrices[] = $estate->getPriceUSD();
                } else {
                    $availablePrices[] = $estate->getPriceUAH();
                }
            }
        }

        return [
            'min' => min($availablePrices),
            'max' => max($availablePrices)
        ];
    }

    public function availableSpaceRange(array $estates)
    {
        $availableSpaces = [];

        foreach( $estates as $estate )
        {
            if( $estate instanceof Estate )
            {
                $availableSpaces[] = $estate->getSpace();
            }
        }

        return [
            'min' => min($availableSpaces),
            'max' => max($availableSpaces)
        ];
    }

    public function availableDistricts(array $estates)
    {
        $availableDistricts = [];

        $existingDistricts = Estate::getDistricts();

        foreach( $estates as $estate )
        {
            if( $estate instanceof Estate )
            {
                if( !in_array($estate->getDistrict(), $availableDistricts, TRUE) &&
                    !empty($existingDistricts[$estate->getDistrict()]) ) {
                    $availableDistricts[$estate->getDistrict()] = $existingDistricts[$estate->getDistrict()];
                }
            }
        }

        return $availableDistricts;
    }
}
