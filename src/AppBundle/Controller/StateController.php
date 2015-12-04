<?php
// src/AppBundle/Controller/StateController.php
namespace AppBundle\Controller;

use DateTime;

use Symfony\Component\HttpKernel\Exception\HttpException,
    Symfony\Component\HttpFoundation\Request,
    Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use AppBundle\Service\Filter\Utility\Interfaces\FilterArgumentsInterface,
    AppBundle\Entity\Article;

class StateController extends Controller implements FilterArgumentsInterface
{
    /**
     * @Method({"GET"})
     * @Route(
     *      "/",
     *      name="index",
     *      host="{_locale}.{domain}",
     *      defaults={"_locale" = "%locale%", "domain" = "%domain%"},
     *      requirements={"_locale" = "%locale%|en", "domain" = "%domain%"}
     * )
     * @Route(
     *      "/",
     *      name="index_default",
     *      host="{domain}",
     *      defaults={"_locale" = "%locale%", "domain" = "%domain%"},
     *      requirements={"domain" = "%domain%"}
     * )
     */
    public function indexAction(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();

        $services = $manager->getRepository('AppBundle:Service')->findAll();

        if( !$services )
            throw $this->createNotFoundException();

        return $this->render('AppBundle:State:index.html.twig', [
            'services' => $services
        ]);
    }

    /**
     * @Method({"GET", "POST"})
     * @Route(
     *      "/catalog/{estateType}",
     *      name="catalog",
     *      host="{_locale}.{domain}",
     *      defaults={"_locale" = "%locale%", "domain" = "%domain%", "estateType" = null},
     *      requirements={"_locale" = "%locale%|en", "domain" = "%domain%", "estateType" = "commercial|residential"}
     * )
     * @Route(
     *      "/catalog/{estateType}",
     *      name="catalog_default",
     *      host="{domain}",
     *      defaults={"_locale" = "%locale%", "domain" = "%domain%", "estateType" = null},
     *      requirements={"domain" = "%domain%", "estateType" = "commercial|residential"}
     * )
     */
    public function catalogAction(Request $request, $estateType)
    {
        if( !$estateType )
            return $this->redirectToRoute('catalog', [
                'estateType' => 'commercial'
            ], 307);

        $manager = $this->getDoctrine()->getManager();

        $estateType = $manager->getRepository('AppBundle:EstateType')->findOneBy(['stringId' => $estateType]);

        if( !$estateType )
            throw $this->createNotFoundException();

        if( $request->request->has(self::FILTER_ROOT) )
            return $this->redirect(
                strtok($request->getRequestUri(), '?') . '?' . http_build_query($request->request->get(self::FILTER_ROOT))
            );

        $filterValidator = $this->get('app.filter.validator');
        $filterCurrency  = $this->get('app.filter.utility.currency');

        $unfilteredEstates = $manager->getRepository('AppBundle:Estate')->findByType($estateType);

        if( $request->query->all() )
        {
            $filterArguments = $request->query->all();

            if( !empty($filterArguments[self::FILTER_CURRENCY]) )
            {
                if( $filterCurrency->getCurrency() && $filterCurrency->getCurrency() !== $filterArguments[self::FILTER_CURRENCY] )
                    $filterArguments[self::FILTER_PRICE] = [];

                $filterCurrency->setCurrency($filterArguments[self::FILTER_CURRENCY]);
            }

            $currency = ( $filterCurrency->getCurrency() ) ?: $filterCurrency->getDefaultCurrency();

            if( !($filterArguments = $filterValidator->validateArguments($filterArguments, $unfilteredEstates, $currency)) )
                throw new HttpException(418, "I'm a teapot");

            $estates = $manager->getRepository('AppBundle:Estate')->findByTypeAndFilterArguments($estateType, $filterArguments, $currency);
        } else {
            $filterArguments = [];

            $filterCurrency->removeCurrency();

            $currency = $filterCurrency->getDefaultCurrency();

            $estates = $unfilteredEstates;
        }

        return $this->render('AppBundle:State:catalog.html.twig', [
            'estateType'        => $estateType->getStringId(),
            'estates'           => $estates,
            'unfilteredEstates' => $unfilteredEstates,
            'filterArguments'   => $filterArguments,
            'currency'          => $currency
        ]);
    }

    /**
     * @Method({"GET"})
     * @Route(
     *      "/catalog/{estateType}/{id}/{slug}",
     *      name="catalog_item",
     *      host="{_locale}.{domain}",
     *      defaults={"_locale" = "%locale%", "domain" = "%domain%"},
     *      requirements={"_locale" = "%locale%|en", "domain" = "%domain%", "estateType" = "commercial|residential", "id" = "\d+", "slug" = "[a-z0-9_]+"}
     * )
     * @Route(
     *      "/catalog/{estateType}/{id}/{slug}",
     *      name="catalog_item_default",
     *      host="{domain}",
     *      defaults={"_locale" = "%locale%", "domain" = "%domain%"},
     *      requirements={"domain" = "%domain%", "estateType" = "commercial|residential", "id" = "\d+", "slug" = "[a-z0-9_]+"}
     * )
     */
    public function catalogItemAction(Request $request, $estateType, $id)
    {
        $manager = $this->getDoctrine()->getManager();

        $estateType = $manager->getRepository('AppBundle:EstateType')->findOneBy(['stringId' => $estateType]);

        if( !$estateType )
            throw $this->createNotFoundException();

        $estate = $manager->getRepository('AppBundle:Estate')->find($id);

        if( !$estate )
            throw $this->createNotFoundException();

        $filterCurrency = $this->get('app.filter.utility.currency');

        $currency = ( $filterCurrency->getCurrency() ) ?: $filterCurrency->getDefaultCurrency();

        $nearestEstates = $manager->getRepository('AppBundle:Estate')->getNearestEstates($id);

        return $this->render('AppBundle:State:catalog_item.html.twig', [
            'estateType'     => $estateType->getStringId(),
            'estate'         => $estate,
            'currency'       => $currency,
            'nearestEstates' => $nearestEstates
        ]);
    }

    /**
     * @Method({"GET"})
     * @Route(
     *      "/services/{alias}",
     *      name="services",
     *      host="{_locale}.{domain}",
     *      defaults={"_locale" = "%locale%", "domain" = "%domain%", "alias" = null},
     *      requirements={"_locale" = "%locale%|en", "domain" = "%domain%", "alias" = "[a-z]+"}
     * )
     * @Route(
     *      "/services/{alias}",
     *      name="services_default",
     *      host="{domain}",
     *      defaults={"_locale" = "%locale%", "domain" = "%domain%", "alias" = null},
     *      requirements={"domain" = "%domain%", "alias" = "[a-z]+"}
     * )
     */
    public function servicesAction($alias = NULL)
    {
        $manager = $this->getDoctrine()->getManager();

        if( $alias )
        {
            $service = $manager->getRepository('AppBundle:Service')->findOneBy(['alias' => $alias]);

            if( !$service )
                throw $this->createNotFoundException();

            $response = [
                'view' => 'AppBundle:State:service.html.twig',
                'data' => ['service' => $service]
            ];
        } else {
            $serviceBenefits = $manager->getRepository('AppBundle:ServiceBenefit')->findBy(['service' => NULL]);

            $clients      = $manager->getRepository('AppBundle:Client')->findAll();
            $clientsChits = $manager->getRepository('AppBundle:ClientChit')->findAll();

            $response = [
                'view' => 'AppBundle:State:services.html.twig',
                'data' => [
                    'serviceBenefits' => $serviceBenefits,
                    'clients'         => $clients,
                    'clientsChits'    => $clientsChits
                ]
            ];
        }

        return $this->render($response['view'], $response['data']);
    }

    /**
     * @Method({"GET"})
     * @Route(
     *      "/staff/{service}",
     *      name="staff",
     *      host="{_locale}.{domain}",
     *      defaults={"_locale" = "%locale%", "domain" = "%domain%", "service" = null},
     *      requirements={"_locale" = "%locale%|en", "domain" = "%domain%", "service" = "[a-z_]+"}
     * )
     * @Route(
     *      "/staff/{service}",
     *      name="staff_default",
     *      host="{domain}",
     *      defaults={"_locale" = "%locale%", "domain" = "%domain%", "service" = null},
     *      requirements={"domain" = "%domain%", "service" = "[a-z_]+"}
     * )
     */
    public function staffAction($service = NULL)
    {
        $manager = $this->getDoctrine()->getManager();

        switch($service)
        {
            case NULL:
                $staff = $manager->getRepository('AppBundle:Staff')->findAll();
            break;

            case 'agency':
                $staff = $manager->getRepository('AppBundle:Staff')->findByServices([
                    'commercial',
                    'residential'
                ]);
            break;

            case 'evaluation':
                $staff = $manager->getRepository('AppBundle:Staff')->findByServices([
                    $service
                ]);
            break;

            case 'management':
                $staff = $manager->getRepository('AppBundle:Staff')->findByServices([
                    $service
                ]);
            break;

            default:
                throw $this->createNotFoundException();
            break;
        }

        return $this->render('AppBundle:State:staff.html.twig', [
            'service' => $service,
            'staff'   => $staff
        ]);
    }

    /**
     * @Method({"GET"})
     * @Route(
     *      "/vacancies",
     *      name="vacancies",
     *      host="{_locale}.{domain}",
     *      defaults={"_locale" = "%locale%", "domain" = "%domain%"},
     *      requirements={"_locale" = "%locale%|en", "domain" = "%domain%"}
     * )
     * @Route(
     *      "/vacancies",
     *      name="vacancies_default",
     *      host="{domain}",
     *      defaults={"_locale" = "%locale%", "domain" = "%domain%"},
     *      requirements={"domain" = "%domain%"}
     * )
     */
    public function vacanciesAction()
    {
        $manager = $this->getDoctrine()->getManager();

        $vacancies = $manager->getRepository('AppBundle:Vacancy')->findAll();

        return $this->render('AppBundle:State:vacancies.html.twig', [
            'vacancies' => $vacancies
        ]);
    }

    /**
     * @Method({"GET"})
     * @Route(
     *      "/news",
     *      name="news",
     *      host="{_locale}.{domain}",
     *      defaults={"_locale" = "%locale%", "domain" = "%domain%"},
     *      requirements={"_locale" = "%locale%|en", "domain" = "%domain%"}
     * )
     * @Route(
     *      "/news",
     *      name="news_default",
     *      host="{domain}",
     *      defaults={"_locale" = "%locale%", "domain" = "%domain%"},
     *      requirements={"domain" = "%domain%"}
     * )
     */
    public function newsAction()
    {
        $manager = $this->getDoctrine()->getManager();

        $news = $manager->getRepository('AppBundle:Article')->findBy([], ['publicationDate' => 'DESC'], Article::ARTICLES_PER_LIFT);

        if( $news ) {
            $articlesAmount   = count($news);
            $articlesLastDate = $news[0]->getPublicationDate();
        } else {
            $articlesAmount   = 0;
            $articlesLastDate = new DateTime;
        }

        return $this->render('AppBundle:State:news.html.twig', [
            'articlesAmount'   => $articlesAmount,
            'articlesLastDate' => $articlesLastDate,
            'news'             => $news
        ]);
    }

    /**
     * @Method({"GET"})
     * @Route(
     *      "/researches/{year}",
     *      name="researches",
     *      host="{_locale}.{domain}",
     *      defaults={"_locale" = "%locale%", "domain" = "%domain%", "year" = null},
     *      requirements={"_locale" = "%locale%|en", "domain" = "%domain%", "year" = "[0-9]+"}
     * )
     * @Route(
     *      "/researches/{year}",
     *      name="researches_default",
     *      host="{domain}",
     *      defaults={"_locale" = "%locale%", "domain" = "%domain%", "year" = null},
     *      requirements={"domain" = "%domain%", "year" = "[0-9]+"}
     * )
     */
    public function researchesAction($year = NULL)
    {
        $indexByCategory = function(array $researches)
        {
            $indexedByCategory = [];

            foreach($researches as $research) {
                $indexedByCategory[$research->getResearchCategory()->getId()][] = $research;
            }

            return $indexedByCategory;
        };

        $currentYear = (new DateTime)->format('Y');

        $years = range($currentYear - 3, $currentYear);

        if( $year ) {
            if( !in_array($year, $years) )
                throw $this->createNotFoundException();
        } else {
            $year = $currentYear;
        }

        $manager = $this->getDoctrine()->getManager();

        $researches = $indexByCategory(
            $manager->getRepository('AppBundle:Research')->findBy(['year' => $year], ['quarter' => 'ASC'])
        );

        $researchCategories = $manager->getRepository('AppBundle:ResearchCategory')->findAll();

        return $this->render('AppBundle:State:researches.html.twig', [
            'requestYear'        => $year,
            'years'              => $years,
            'researches'         => $researches,
            'researchCategories' => $researchCategories
        ]);
    }

    /**
     * @Method({"GET"})
     * @Route(
     *      "/expats_relocation",
     *      name="expats_relocation",
     *      host="{_locale}.{domain}",
     *      defaults={"_locale" = "%locale%", "domain" = "%domain%"},
     *      requirements={"_locale" = "%locale%|en", "domain" = "%domain%"}
     * )
     * @Route(
     *      "/expats_relocation",
     *      name="expats_relocation_default",
     *      host="{domain}",
     *      defaults={"_locale" = "%locale%", "domain" = "%domain%"},
     *      requirements={"domain" = "%domain%"}
     * )
     */
    public function expatsRelocationAction()
    {
        $manager = $this->getDoctrine()->getManager();

        $relocationSteps = $manager->getRepository('AppBundle:RelocationStep')->findAll();

        if( !$relocationSteps )
            throw $this->createNotFoundException();

        return $this->render('AppBundle:State:expats_relocation.html.twig', [
            'relocationSteps' => $relocationSteps
        ]);
    }

    /**
     * @Method({"GET"})
     * @Route(
     *      "/expats_information",
     *      name="expats_information",
     *      host="{_locale}.{domain}",
     *      defaults={"_locale" = "%locale%", "domain" = "%domain%"},
     *      requirements={"_locale" = "%locale%|en", "domain" = "%domain%"}
     * )
     * @Route(
     *      "/expats_information",
     *      name="expats_information_default",
     *      host="{domain}",
     *      defaults={"_locale" = "%locale%", "domain" = "%domain%"},
     *      requirements={"domain" = "%domain%"}
     * )
     */
    public function expatsInformationAction()
    {
        $manager = $this->getDoctrine()->getManager();

        $informationCategories = $manager->getRepository('AppBundle:InformationCategory')->findAll();

        return $this->render('AppBundle:State:expats_information.html.twig', [
            'informationCategories' => $informationCategories
        ]);
    }

    /**
     * @Method({"GET"})
     * @Route(
     *      "/contacts",
     *      name="contacts",
     *      host="{_locale}.{domain}",
     *      defaults={"_locale" = "%locale%", "domain" = "%domain%"},
     *      requirements={"_locale" = "%locale%|en", "domain" = "%domain%"}
     * )
     * @Route(
     *      "/contacts",
     *      name="contacts_default",
     *      host="{domain}",
     *      defaults={"_locale" = "%locale%", "domain" = "%domain%"},
     *      requirements={"domain" = "%domain%"}
     * )
     */
    public function contactsAction()
    {
        $manager = $this->getDoctrine()->getManager();

        $contact = $manager->getRepository('AppBundle:Contact')->findOneBy([], [], 1);

        if( !$contact )
            throw $this->createNotFoundException();

        return $this->render('AppBundle:State:contacts.html.twig', [
            'contact' => $contact
        ]);
    }
}
