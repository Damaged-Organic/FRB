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

    public function validateArguments(array $filterArguments, array $estates)
    {
        if( !empty($filterArguments[self::FILTER_DISTRICTS]) )
        {
            if (!$this->validateDistricts($filterArguments[self::FILTER_DISTRICTS]))
                return FALSE;
        }

        if( !empty($filterArguments[self::FILTER_ESTATE_TYPE]) )
        {
            if (!$this->validateEstateType($filterArguments[self::FILTER_ESTATE_TYPE], $estates))
                return FALSE;
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