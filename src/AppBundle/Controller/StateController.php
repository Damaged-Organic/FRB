<?php
// src/AppBundle/Controller/StateController.php
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use AppBundle\Controller\Routing\RoutingController,
    AppBundle\Controller\Contract\PageInitInterface;

class StateController extends RoutingController implements PageInitInterface
{
    public function indexAction(Request $request)
    {
        return $this->render('AppBundle:State:index.html.twig', [
            'route'    => $this->get('app.metadata')->getCurrentRoute(),
            'metadata' => $this->get('app.metadata')->getCurrentMetadata()
        ]);
    }
}