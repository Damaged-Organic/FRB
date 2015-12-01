<?php
// src/AppBundle/Controller/FilterController.php
namespace AppBundle\Controller;

use AppBundle\Entity\Estate;
use Symfony\Component\HttpFoundation\Request,
    Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class FilterController extends Controller
{
    public function estateTypeFilterAction(Request $request)
    {
        return $this->render('AppBundle:Filter:estate_type.html.twig');
    }

    public function tradeTypeFilterAction(Request $request)
    {
        return $this->render('AppBundle:Filter:trade_type.html.twig');
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

    public function districtFilterAction(Request $request)
    {
        //district[]=holosiivskyi

        $districts = Estate::getDistricts();

        return $this->render('AppBundle:Filter:district.html.twig', [
            'districts' => $districts
        ]);
    }
}