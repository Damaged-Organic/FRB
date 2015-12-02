<?php
// src/AppBundle/Service/Filter/AvailableValuesExtractor.php
namespace AppBundle\Service\Filter;

use AppBundle\Entity\Estate;

class AvailableValuesExtractor
{
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

        foreach( $estates as $estate )
        {
            if( $estate instanceof Estate )
                $availableTradeTypes[$estate->getTradeType()] = ( $flatValues ) ? $estate->getTradeType();
        }

        return $availableTradeTypes;
    }
}