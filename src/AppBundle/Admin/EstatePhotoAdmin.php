<?php
// src/AppBundle/Admin/EstatePhotoAdmin.php
namespace AppBundle\Admin;

use Symfony\Component\DependencyInjection\ContainerInterface;

use Sonata\AdminBundle\Admin\Admin,
    Sonata\AdminBundle\Datagrid\ListMapper,
    Sonata\AdminBundle\Datagrid\DatagridMapper,
    Sonata\AdminBundle\Form\FormMapper,
    Sonata\AdminBundle\Route\RouteCollection;

use Pix\SortableBehaviorBundle\Services\PositionHandler;

class EstatePhotoAdmin extends Admin
{
    public $last_position = 0;

    private $positionService;

    public function setPositionService(PositionHandler $positionHandler)
    {
        $this->positionService = $positionHandler;
    }

    protected $datagridValues = array(
        '_page'       => 1,
        '_sort_order' => 'ASC',
        '_sort_by'    => 'position',
    );

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection
            ->add('move', $this->getRouterIdParameter().'/move/{position}')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $this->last_position = $this->positionService->getLastPosition($this->getRoot()->getClass());

        $listMapper
            ->addIdentifier("id", "number", [
                "label" => "ID"
            ])
            ->add('_action', 'actions', [
                'actions' => [
                    'move' => [
                        'template' => 'PixSortableBehaviorBundle:Default:_sort.html.twig'
                    ]
                ]
            ])
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $photoPathData = ( ($estatePhoto = $this->getSubject()) && ($photoPath = $estatePhoto->getPhotoPath()) )
            ? $photoPath
            : FALSE;

        $formMapper
            ->add('photoPath', 'text', [
                'label'     => "Ім’я файлу",
                'required'  => FALSE,
                'mapped'    => FALSE,
                'read_only' => TRUE,
                'data'      => $photoPathData,
                'attr' => [
                    'hidden' => TRUE
                ]
            ])
            ->add('photoFile', 'file', [
                'label'    => "Додати файл",
                'required' => !$photoPathData
            ])
            ->add('position','hidden', [
                'attr' => [
                    "hidden" => TRUE
                ]
            ])
        ;
    }
}
