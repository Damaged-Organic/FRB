<?php
// src/AppBundle/Service/Filter/AvailableValuesExtractor.php
namespace AppBundle\Service\Filter;

use AppBundle\Entity\Estate,
    AppBundle\Entity\EstateFeatures,
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

        if( $availablePrices )
        {
            $priceMin = min($availablePrices);
            $priceMax = max($availablePrices);

            $availablePrices = [
                'min' => ( $priceMin != $priceMax ) ? $priceMin : 0,
                'max' => $priceMax
            ];
        } else {
            $availablePrices = [
                'min' => NULL,
                'max' => NULL
            ];
        }

        return $availablePrices;
    }

    public function availableSpaceRange(array $estates)
    {
        $availableSpaces = [];

        foreach( $estates as $estate )
        {
            if( $estate instanceof Estate )
                $availableSpaces[] = $estate->getSpace();
        }

        if( $availableSpaces )
        {
            $spaceMin = min($availableSpaces);
            $spaceMax = max($availableSpaces);

            $availableSpaces = [
                'min' => ( $spaceMin != $spaceMax ) ? $spaceMin : 0,
                'max' => $spaceMax
            ];
        } else {
            $availableSpaces = [
                'min' => NULL,
                'max' => NULL
            ];
        }

        return $availableSpaces;
    }

    public function availableSpacePlotRange(array $estates)
    {
        $availablePlotSpaces = [];

        foreach( $estates as $estate )
        {
            if( $estate instanceof Estate )
                $availablePlotSpaces[] = $estate->getSpacePlot();
        }

        if( $availablePlotSpaces )
        {
            $spacePlotMin = min($availablePlotSpaces);
            $spacePlotMax = max($availablePlotSpaces);

            $availablePlotSpaces = [
                'min' => ( $spacePlotMin != $spacePlotMax ) ? $spacePlotMin : 0,
                'max' => $spacePlotMax
            ];
        } else {
            $availablePlotSpaces = [
                'min' => NULL,
                'max' => NULL
            ];
        }

        return $availablePlotSpaces;
    }

    public function availableFeatures($estates)
    {
        $availableFeatures = [];

        $existingEstateFeatures = EstateFeatures::getEstateFeatures();

        foreach( $estates as $estate )
        {
            if( $estate instanceof Estate )
            {
                $estateFeatures = $estate->getEstateFeatures();

                if( $estateFeatures instanceof EstateFeatures )
                {
                    foreach( $existingEstateFeatures as $feature )
                    {
                        if( $estateFeatures->getFeatureByName($feature) )
                            $availableFeatures[$feature] = $estateFeatures->getFeatureByName($feature);
                    }
                }
            }
        }

        return $availableFeatures;
    }

    public function availableAttributes(array $estates)
    {
        $availableAttributes = [];

        foreach($estates as $estate)
        {
            if( $estate instanceof Estate )
            {
                if( $estate->getEstateAttribute() )
                {
                    foreach( $estate->getEstateAttribute() as $attribute )
                    {
                        if( $attribute->getEstateAttributeType()->getPostfix() && is_numeric($attribute->getValue()) )
                            $availableAttributes[$attribute->getEstateAttributeType()->getId()][] = $attribute->getValue();
                    }
                }
            }
        }

        foreach( $availableAttributes as $attribute => $values )
        {
            if( $availableAttributes[$attribute] )
            {
                $min = min($availableAttributes[$attribute]);
                $max = max($availableAttributes[$attribute]);


                $availableAttributes[$attribute] = [
                    'min' => ( $min != $max ) ? $min : 0,
                    'max' => $max
                ];
            } else {
                $availableAttributes[$attribute] = [
                    'min' => NULL,
                    'max' => NULL
                ];
            }
        }

        return $availableAttributes;
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
