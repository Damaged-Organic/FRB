<?php
// src/MenuBundle/Menu/MenuBuilder.php
namespace MenuBundle\Menu;

use Doctrine\ORM\EntityManager;

use Knp\Menu\FactoryInterface;

use Symfony\Component\HttpFoundation\RequestStack;

class MenuBuilder
{
    private $_factory;
    private $_manager;

    public function __construct(FactoryInterface $factory, EntityManager $manager)
    {
        $this->_factory = $factory;
        $this->_manager = $manager;
    }

    public function createMainMenu(RequestStack $requestStack)
    {
        // $menu = $this->_factory->createItem('root');
        //
        // $items = $this->_manager->getRepository('MenuBundle:Menu')->findAll();
        //
        // $menu->setChildrenAttribute('class', 'nav');
        // $menu->setExtra('currentElement', 'active');
        //
        // $currentRoute = $requestStack->getMasterRequest()->attributes->get('_route');
        //
        // foreach($items as $item)
        // {
        //     $menu->addChild($item->getTitle(), ['route' => $item->getRoute()]);
        //
        //     if( $item->getRoute() === str_replace("_default", "", $currentRoute) )
        //         $menu[$item->getTitle()]->setCurrent(TRUE);
        // }
        //
        // if( str_replace("_default", "", $currentRoute) == 'catalog_proposal' ||
        //     str_replace("_default", "", $currentRoute) == 'catalog_item' ) {
        //     foreach( $items as $item ) {
        //         if( $item->getRoute() == 'catalog' )
        //             $menu[$item->getTitle()]->setCurrent(TRUE);
        //     };
        // }
        //
        // if( str_replace("_default", "", $currentRoute) == 'expats_relocation' ||
        //     str_replace("_default", "", $currentRoute) == 'expats_information') {
        //     foreach( $items as $item ) {
        //         if( $item->getRoute() == 'services' )
        //             $menu[$item->getTitle()]->setCurrent(TRUE);
        //     };
        // }
        //
        // unset($this);
        //
        // return $menu;
    }
}
