<?php
// src/AppBundle/Controller/FilterController.php
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpFoundation\RequestStack,
    Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use AppBundle\Service\Filter\Utility\Interfaces\FilterArgumentsInterface,
    AppBundle\Entity\Estate,
    AppBundle\Service\Filter\Utility\Currency;

class FilterController extends Controller implements FilterArgumentsInterface
{
    public function estateTypeFilterAction(array $filterArguments, array $estates)
    {
        $filterAvailableValuesExtractor = $this->get('app.filter.available_values_extractor');

        $estateTypes = $filterAvailableValuesExtractor->availableEstateTypes($estates);

        $checked = ( !empty($filterArguments[self::FILTER_ESTATE_TYPE]) ) ? $filterArguments[self::FILTER_ESTATE_TYPE] : [];

        return $this->render('AppBundle:Filter:estate_type.html.twig', [
            'estateTypes' => $estateTypes,
            'checked'     => $checked
        ]);
    }

    public function tradeTypeFilterAction(array $filterArguments, array $estates)
    {
        $filterAvailableValuesExtractor = $this->get('app.filter.available_values_extractor');

        $tradeTypes = $filterAvailableValuesExtractor->availableTradeTypes($estates);

        $checked = ( !empty($filterArguments[self::FILTER_TRADE_TYPE]) ) ? $filterArguments[self::FILTER_TRADE_TYPE] : [];

        return $this->render('AppBundle:Filter:trade_type.html.twig', [
            'tradeTypes' => $tradeTypes,
            'checked'    => $checked
        ]);
    }

    public function currencyFilterAction(array $filterArguments, array $estates)
    {
        $filterAvailableValuesExtractor = $this->get('app.filter.available_values_extractor');

        $currencies = $filterAvailableValuesExtractor->availableCurrencies();

        $checked = ( !empty($filterArguments[self::FILTER_CURRENCY]) ) ? $filterArguments[self::FILTER_CURRENCY] : Currency::getDefaultCurrency();

        return $this->render('AppBundle:Filter:currency.html.twig', [
            'currencies' => $currencies,
            'checked'    => $checked
        ]);
    }

    public function priceFilterAction(array $filterArguments, array $estates, $currency)
    {
        $filterAvailableValuesExtractor = $this->get('app.filter.available_values_extractor');

        $priceRange = $filterAvailableValuesExtractor->availablePriceRange($estates, $currency);

        $values = ( !empty($filterArguments[self::FILTER_PRICE]) ) ? $filterArguments[self::FILTER_PRICE] : [];

        return $this->render('AppBundle:Filter:price.html.twig', [
            'currency'   => $currency,
            'priceRange' => $priceRange,
            'values'     => $values
        ]);
    }

    public function spaceFilterAction(array $filterArguments, array $estates)
    {
        $filterAvailableValuesExtractor = $this->get('app.filter.available_values_extractor');

        $spaceRange = $filterAvailableValuesExtractor->availableSpaceRange($estates);

        $values = ( !empty($filterArguments[self::FILTER_SPACE]) ) ? $filterArguments[self::FILTER_SPACE] : [];

        return $this->render('AppBundle:Filter:space.html.twig', [
            'spaceRange' => $spaceRange,
            'values'     => $values
        ]);
    }

    public function spacePlotFilterAction(array $filterArguments, array $estates)
    {
        $filterAvailableValuesExtractor = $this->get('app.filter.available_values_extractor');

        $spacePlotRange = $filterAvailableValuesExtractor->availableSpacePlotRange($estates);

        $values = ( !empty($filterArguments[self::FILTER_SPACE_PLOT]) ) ? $filterArguments[self::FILTER_SPACE_PLOT] : [];

        return $this->render('AppBundle:Filter:space_plot.html.twig', [
            'spacePlotRange' => $spacePlotRange,
            'values'         => $values
        ]);
    }

    public function featureFilterAction(array $filterArguments, array $estates)
    {
        $filterAvailableValuesExtractor = $this->get('app.filter.available_values_extractor');

        $features = $filterAvailableValuesExtractor->availableFeatures($estates);

        if( !empty($filterArguments['estate_type']) && ($filterArguments['estate_type'] == 3 || $filterArguments['estate_type'] == 4) )
        {
            if( $filterArguments['estate_type'] == 3 )
            {
                var_dump($features, $filterArguments);
            }
        } elseif( $estates ) {
            echo '<pre>';
            \Doctrine\Common\Util\Debug::dump($this->get('request_stack')->getMasterRequest(), 3);
            echo '</pre>';
        }

        $checked = ( !empty($filterArguments[self::FILTER_FEATURES]) ) ? $filterArguments[self::FILTER_FEATURES] : [];

        return $this->render('AppBundle:Filter:feature.html.twig', [
            'features' => $features,
            'checked'  => $checked
        ]);
    }

    public function attributeFilterAction(array $filterArguments, array $estates, $estateAttributeType)
    {
        $filterAvailableValuesExtractor = $this->get('app.filter.available_values_extractor');

        $attributes = $filterAvailableValuesExtractor->availableAttributes($estates);

        $values = ( !empty($filterArguments[self::FILTER_ATTRIBUTES]) ) ? $filterArguments[self::FILTER_ATTRIBUTES] : [];

        return $this->render('AppBundle:Filter:attribute.html.twig', [
            'attributes'          => $attributes,
            'values'              => $values,
            'estateAttributeType' => $estateAttributeType
        ]);
    }

    public function districtFilterAction(array $filterArguments, array $estates)
    {
        $filterAvailableValuesExtractor = $this->get('app.filter.available_values_extractor');

        $districts = $filterAvailableValuesExtractor->availableDistricts($estates);

        $checked = ( !empty($filterArguments[self::FILTER_DISTRICTS]) ) ? $filterArguments[self::FILTER_DISTRICTS] : [];

        return $this->render('AppBundle:Filter:district.html.twig', [
            'districts' => $districts,
            'checked'   => $checked
        ]);
    }

    public function searchFilterAction(array $filterArguments)
    {
        $value = ( !empty($filterArguments[self::FILTER_SEARCH]) ) ? $filterArguments[self::FILTER_SEARCH] : '';

        return $this->render('AppBundle:Filter:search.html.twig', [
            'value' => $value
        ]);
    }
}
