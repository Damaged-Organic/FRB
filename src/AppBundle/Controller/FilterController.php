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
    // All
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

    // All
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

    // All
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

    // All
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

    // Variable
    public function pricePerSquareFilterAction(array $filterArguments, array $estates, $currency)
    {
        $filterAvailableValuesExtractor = $this->get('app.filter.available_values_extractor');

        $pricePerSquareRange = $filterAvailableValuesExtractor->availablePricePerSquareRange($estates, $currency);

        # BIG FAT KLUDGE
        $pricePerSquareRange = $this->featurePricePerSquareRangeKludge($pricePerSquareRange, $filterArguments);
        # KLUDGES NEVER END

        $values = ( !empty($filterArguments[self::FILTER_PRICE_PER_SQUARE]) ) ? $filterArguments[self::FILTER_PRICE_PER_SQUARE] : [];

        return $this->render('AppBundle:Filter:price_per_square.html.twig', [
            'currency'            => $currency,
            'pricePerSquareRange' => $pricePerSquareRange,
            'values'              => $values
        ]);
    }

    private function featurePricePerSquareRangeKludge($pricePerSquareRange = [], $filterArguments)
    {
        $estateType = $this->get('request_stack')->getMasterRequest()->attributes->get('_route_params')['estateType'];

        if( $estateType == 'residential' )
        {
            if( empty($filterArguments['estate_type']) )
                return $pricePerSquareRange;

            if( $filterArguments['estate_type'] == 3 )
            {
                if( empty($filterArguments['trade_type']) )
                    return $pricePerSquareRange;

                if( $filterArguments['trade_type'] == 'trade_type_rent' ) {
                    return ['min' => NULL, 'max' => NULL];
                }

                if( $filterArguments['trade_type'] == 'trade_type_sale' ) {
                    return $pricePerSquareRange;
                }
            }

            if( $filterArguments['estate_type'] == 4 )
            {
                if( empty($filterArguments['trade_type']) )
                    return $pricePerSquareRange;

                if( $filterArguments['trade_type'] == 'trade_type_rent' ) {
                    return ['min' => NULL, 'max' => NULL];
                }

                if( $filterArguments['trade_type'] == 'trade_type_sale' ) {
                    return $pricePerSquareRange;
                }
            }
        }

        if( $estateType == 'commercial' )
        {
            if( empty($filterArguments['trade_type']) )
                return $pricePerSquareRange;

            if( $filterArguments['trade_type'] == 'trade_type_rent' ){
                return $pricePerSquareRange;
            }

            if( $filterArguments['trade_type'] == 'trade_type_sale' ) {
                return $pricePerSquareRange;
            }
        }
    }

    // All
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

    // Exclude
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

    // Variable
    public function featureFilterAction(array $filterArguments, array $estates)
    {
        $filterAvailableValuesExtractor = $this->get('app.filter.available_values_extractor');

        $features = $filterAvailableValuesExtractor->availableFeatures($estates);

        # BIG FAT KLUDGE
        $features = $this->featureFilterKludge($features, $filterArguments);
        # KLUDGES NEVER END

        $checked = ( !empty($filterArguments[self::FILTER_FEATURES]) ) ? $filterArguments[self::FILTER_FEATURES] : [];

        return $this->render('AppBundle:Filter:feature.html.twig', [
            'features' => $features,
            'checked'  => $checked
        ]);
    }

    private function featureFilterKludge($features = [], array $filterArguments)
    {
        $estateType = $this->get('request_stack')->getMasterRequest()->attributes->get('_route_params')['estateType'];

        if( $estateType == 'residential' )
        {
            if( empty($filterArguments['estate_type']) )
                return ( isset($features['isNewBuilding']) ) ? ['isNewBuilding' => $features['isNewBuilding']] : [];

            if( $filterArguments['estate_type'] == 3 )
            {
                if( empty($filterArguments['trade_type']) )
                    return ( isset($features['isNewBuilding']) ) ? ['isNewBuilding' => $features['isNewBuilding']] : [];

                if( $filterArguments['trade_type'] == 'trade_type_rent' ) {
                    return ( isset($features['isNewBuilding']) ) ? ['isNewBuilding' => $features['isNewBuilding']] : [];
                }

                if( $filterArguments['trade_type'] == 'trade_type_sale' ) {
                    return ( isset($features['isNewBuilding']) ) ? ['isNewBuilding' => $features['isNewBuilding']] : [];
                }
            }

            if( $filterArguments['estate_type'] == 4 )
            {
                if( empty($filterArguments['trade_type']) )
                    return [];

                if( $filterArguments['trade_type'] == 'trade_type_rent' ) {
                    return [];
                }

                if( $filterArguments['trade_type'] == 'trade_type_sale' ) {
                    return [];
                }
            }
        }

        if( $estateType == 'commercial' )
        {
            if( empty($filterArguments['trade_type']) )
                return [];

            if( $filterArguments['trade_type'] == 'trade_type_rent' ){
                return [];
            }

            if( $filterArguments['trade_type'] == 'trade_type_sale' ) {
                return [];
            }
        }
    }

    // Variable
    public function attributeFilterAction(array $filterArguments, array $estates, $estateAttributeType)
    {
        $filterAvailableValuesExtractor = $this->get('app.filter.available_values_extractor');

        $attributes = $filterAvailableValuesExtractor->availableAttributes($estates);

        # BIG FAT KLUDGE
        $attributes = $this->attributeFilterKludge($attributes, $filterArguments);
        # KLUDGES NEVER END

        $values = ( !empty($filterArguments[self::FILTER_ATTRIBUTES]) ) ? $filterArguments[self::FILTER_ATTRIBUTES] : [];

        return $this->render('AppBundle:Filter:attribute.html.twig', [
            'attributes'          => $attributes,
            'values'              => $values,
            'estateAttributeType' => $estateAttributeType
        ]);
    }

    private function attributeFilterKludge($attributes = [], array $filterArguments)
    {
        $fill = function(array $input, array $indexes) {
            $output = [];

            foreach( $indexes as $index ) {
                if( !empty($input[$index]) )
                    $output[$index] = $input[$index];
            }

            return $output;
        };

        $estateType = $this->get('request_stack')->getMasterRequest()->attributes->get('_route_params')['estateType'];

        if( $estateType == 'residential' )
        {
            if( empty($filterArguments['estate_type']) )
                return $fill($attributes, [1, 3]);

            if( $filterArguments['estate_type'] == 3 )
            {
                if( empty($filterArguments['trade_type']) )
                    return $fill($attributes, [3]);

                if( $filterArguments['trade_type'] == 'trade_type_rent' ) {
                    return $fill($attributes, [3]);
                }

                if( $filterArguments['trade_type'] == 'trade_type_sale' ) {
                    return $fill($attributes, [3]);
                }
            }

            if( $filterArguments['estate_type'] == 4 )
            {
                if( empty($filterArguments['trade_type']) )
                    return $fill($attributes, [1]);

                if( $filterArguments['trade_type'] == 'trade_type_rent' ) {
                    return $fill($attributes, [1]);
                }

                if( $filterArguments['trade_type'] == 'trade_type_sale' ) {
                    return $fill($attributes, [1]);
                }
            }
        }

        if( $estateType == 'commercial' )
        {
            if( empty($filterArguments['trade_type']) )
                return $fill($attributes, [1, 2]);

            if( $filterArguments['trade_type'] == 'trade_type_rent' ){
                return $fill($attributes, [1, 2]);
            }

            if( $filterArguments['trade_type'] == 'trade_type_sale' ) {
                return $fill($attributes, [1, 2]);
            }
        }
    }

    // All
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
