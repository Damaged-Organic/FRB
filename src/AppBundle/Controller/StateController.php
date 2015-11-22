<?php
// src/AppBundle/Controller/StateController.php
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class StateController extends Controller
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
    public function indexAction()
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
     * @Method({"GET"})
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
    public function catalogAction($estateType)
    {
        //TODO: residential parameter kludge
        return $this->render('AppBundle:State:catalog.html.twig');
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
     *      "/staff",
     *      name="staff",
     *      host="{_locale}.{domain}",
     *      defaults={"_locale" = "%locale%", "domain" = "%domain%"},
     *      requirements={"_locale" = "%locale%|en", "domain" = "%domain%"}
     * )
     * @Route(
     *      "/staff",
     *      name="staff_default",
     *      host="{domain}",
     *      defaults={"_locale" = "%locale%", "domain" = "%domain%"},
     *      requirements={"domain" = "%domain%"}
     * )
     */
    public function staffAction()
    {
        $manager = $this->getDoctrine()->getManager();

        $staff = $manager->getRepository('AppBundle:Staff')->findAll();

        return $this->render('AppBundle:State:staff.html.twig', [
            'staff' => $staff
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
        return $this->render('AppBundle:State:vacancies.html.twig');
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
        return $this->render('AppBundle:State:news.html.twig');
    }

    /**
     * @Method({"GET"})
     * @Route(
     *      "/researches",
     *      name="researches",
     *      host="{_locale}.{domain}",
     *      defaults={"_locale" = "%locale%", "domain" = "%domain%"},
     *      requirements={"_locale" = "%locale%|en", "domain" = "%domain%"}
     * )
     * @Route(
     *      "/researches",
     *      name="researches_default",
     *      host="{domain}",
     *      defaults={"_locale" = "%locale%", "domain" = "%domain%"},
     *      requirements={"domain" = "%domain%"}
     * )
     */
    public function researchesAction()
    {
        return $this->render('AppBundle:State:researches.html.twig');
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
        return $this->render('AppBundle:State:expats_relocation.html.twig');
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
        return $this->render('AppBundle:State:expats_information.html.twig');
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
        return $this->render('AppBundle:State:contacts.html.twig');
    }
}