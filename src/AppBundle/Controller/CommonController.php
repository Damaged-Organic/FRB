<?php
// src/AppBundle/Controller/CommonController.php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class CommonController extends Controller
{
    public function headerAction(Request $request, $type)
    {
        switch($type)
        {
            case 'intro':
                $template = 'AppBundle:Common:header_intro.html.twig';
            break;

            case 'common':
                $template = 'AppBundle:Common:header.html.twig';
            break;

            default:
                throw $this->createNotFoundException();
            break;
        }

        return $this->render($template, [
            'route' => $request->get('_route')
        ]);
    }

    public function footerAction()
    {
        return $this->render('AppBundle:Common:footer.html.twig');
    }

    public function servicesAction($alias = NULL)
    {
        $manager = $this->getdoctrine()->getManager();

        $services = $manager->getRepository('AppBundle:Service')->findAll();

        return $this->render('AppBundle:Common:services.html.twig', [
            'alias'    => $alias,
            'services' => $services
        ]);
    }
}