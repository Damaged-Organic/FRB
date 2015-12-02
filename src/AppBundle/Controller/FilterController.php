<?php
// src/AppBundle/Controller/FilterController.php
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use AppBundle\Service\Filter\Utility\Interfaces\FilterArgumentsInterface,
    AppBundle\Entity\Estate;

class FilterController extends Controller implements FilterArgumentsInterface
{
    public function estateTypeFilterAction(Request $request, $estates)
    {
        $filterAvailableValuesExtractor = $this->get('app.filter.available_values_extractor');

        $estateTypes = $filterAvailableValuesExtractor->availableEstateTypes($estates);

        $checked = ( $request->query->get(self::FILTER_ESTATE_TYPE) ) ?: [];

        return $this->render('AppBundle:Filter:estate_type.html.twig', [
            'estateTypes' => $estateTypes,
            'checked'     => $checked
        ]);
    }

    public function tradeTypeFilterAction(Request $request, $estates)
    {
        $filterAvailableValuesExtractor = $this->get('app.filter.available_values_extractor');

        $tradeTypes = $filterAvailableValuesExtractor->availableTradeTypes($estates);

        $checked = ( $request->query->get(self::FILTER_TRADE_TYPE) ) ?: [];

        return $this->render('AppBundle:Filter:trade_type.html.twig', [
            'tradeTypes' => $tradeTypes,
            'checked'    => $checked
        ]);
    }

    public function currencyFilterAction()
    {
        return $this->render('AppBundle:Filter:currency.html.twig');
    }

    public function spaceFilterAction(Request $request)
    {
        return $this->render('AppBundle:Filter:space.html.twig');
    }

    public function priceFilterAction(Request $request)
    {
        return $this->render('AppBundle:Filter:price.html.twig');
    }

    public function attributeFilterAction(Request $request)
    {
        return $this->render('AppBundle:Filter:attribute.html.twig');
    }

    public function featureFilterAction(Request $request)
    {
        return $this->render('AppBundle:Filter:feature.html.twig');
    }

    public function districtFilterAction(Request $request, $estates)
    {
        $filterAvailableValuesExtractor = $this->get('app.filter.available_values_extractor');

        $districts = $filterAvailableValuesExtractor->availableDistricts($estates);

        $checked = ( $request->query->get(self::FILTER_DISTRICTS) ) ?: [];

        return $this->render('AppBundle:Filter:district.html.twig', [
            'districts' => $districts,
            'checked'   => $checked
        ]);
    }
}