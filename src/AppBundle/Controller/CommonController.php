<?php
// src/AppBundle/Controller/CommonController.php
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

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
            'path' => trim($request->getPathInfo(), '/')
        ]);
    }

    public function menuAction(Request $request, $indented = FALSE)
    {
        $manager = $this->getdoctrine()->getManager();

        $router = $this->get('router');

        $renderedMenu = [];

        $menu = $manager->getRepository('MenuBundle:Menu')->findAll();

        $estateTypes = $manager->getRepository('AppBundle:EstateType')->findBy(['parent' => NULL]);
        $services    = $manager->getRepository('AppBundle:Service')->findAll();

        $currentRoute       = $request->attributes->get('request')->get('_route');
        $currentRouteParams = $request->attributes->get('request')->get('_route_params');

        foreach( $menu as $key => $menuItem )
        {
            if( !$menuItem->getBlock() )
                continue;

            if( $menuItem->getRoute() == 'catalog' )
            {
                $renderedMenu[$menuItem->getBlock()]['outer'] = [
                    'title'  => $menuItem->getTitle(),
                    'route'  => $router->generate($menuItem->getRoute(), ['_locale' => $request->getLocale()]),
                    'active' => ( $currentRoute == 'catalog' ) ? TRUE : FALSE
                ];

                if( $indented )
                {
                    foreach( $estateTypes as $estateType )
                    {
                        $renderedMenu[$menuItem->getBlock()]['inner'][] = [
                            'title'  => $estateType->getTitle(),
                            'route'  => $router->generate($menuItem->getRoute(), ['estateType' => $estateType->getStringId()]),
                            'active' => ( !empty($currentRouteParams['estateType']) && $currentRouteParams['estateType'] == $estateType->getStringId() ) ? TRUE : FALSE
                        ];
                    }

                    $renderedMenu[$menuItem->getBlock()]['inner'] = array_reverse($renderedMenu[$menuItem->getBlock()]['inner']);
                }
            } elseif( $menuItem->getBlock() == 'services' ) {
                if( $menuItem->getRoute() == 'services' )
                {
                    $renderedMenu[$menuItem->getBlock()]['outer'] = [
                        'title'  => $menuItem->getTitle(),
                        'route'  => $router->generate($menuItem->getRoute(), ['_locale' => $request->getLocale()]),
                        'active' => ( $currentRoute == 'services' ) ? TRUE : FALSE
                    ];

                    if( $indented )
                    {
                        foreach( $services as $service )
                        {
                            $renderedMenu[$menuItem->getBlock()]['inner'][] = [
                                'title'  => $service->getTitle(),
                                'route'  => $router->generate($menuItem->getRoute(), ['alias' => $service->getAlias()]),
                                'active' => ( !empty($currentRouteParams['alias']) && $currentRouteParams['alias'] == $service->getAlias() ) ? TRUE : FALSE
                            ];
                        }
                    }
                }

                if( $menuItem->getRoute() == 'expats_information' ||
                    $menuItem->getRoute() == 'expats_relocation' ) {
                    $renderedMenu[$menuItem->getBlock()]['inner'][] = [
                        'title'  => $menuItem->getTitle(),
                        'route'  => $router->generate($menuItem->getRoute(), ['_locale' => $request->getLocale()]),
                        'active' => ( $currentRoute == $menuItem->getRoute() ) ? TRUE : FALSE
                    ];

                    if( $currentRoute == 'expats_information' ||
                        $currentRoute == 'expats_relocation') {
                        $renderedMenu[$menuItem->getBlock()]['outer']['active'] = TRUE;
                    }
                }
            } else {
                $renderedMenu[$menuItem->getBlock()][] = [
                    'title'  => $menuItem->getTitle(),
                    'route'  => $router->generate($menuItem->getRoute(), ['_locale' => $request->getLocale()]),
                    'active' => ( $currentRoute == $menuItem->getRoute() ) ? TRUE : FALSE
                ];
            }
        }

        $template = ( $indented ) ? 'AppBundle:Common:menu.html.twig' : 'AppBundle:Common:menu_intro.html.twig';

        return $this->render($template, [
            'menu' => $renderedMenu
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

    public function paginationBarAction($estateType, $filterArguments)
    {
        $paginationBar = $this->get('app.pagination_bar')->getPaginationBar();

        return $this->render('AppBundle:Common:paginationBar.html.twig', [
            'paginationBar'   => $paginationBar,
            'estateType'      => $estateType,
            'filterArguments' => $filterArguments
        ]);
    }
}
