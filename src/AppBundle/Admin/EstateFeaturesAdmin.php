<?php
// src/AppBundle/Admin/EstateFeaturesAdmin.php
namespace AppBundle\Admin;

use Symfony\Component\Validator\Constraints as Assert;

use Sonata\AdminBundle\Admin\Admin,
    Sonata\AdminBundle\Datagrid\ListMapper,
    Sonata\AdminBundle\Datagrid\DatagridMapper,
    Sonata\AdminBundle\Form\FormMapper,
    Sonata\AdminBundle\Route\RouteCollection;

use AppBundle\Entity\EstateFeatures;

class EstateFeaturesAdmin extends Admin
{
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection
            ->remove('create')
            ->remove('delete')
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add("isCashless", "checkbox", [
                "label"    => "Безготівковий розрахунок",
                "required" => FALSE
            ])
            ->add("isNewBuilding", "checkbox", [
                "label"    => "Нова будівля",
                "required" => FALSE
            ])
            ->add("hasElevator", "checkbox", [
                "label"    => "Наявність ліфту",
                "required" => FALSE
            ])
            ->add("hasParking", "checkbox", [
                "label"    => "Наявність парковки",
                "required" => FALSE
            ])
            ->add("hasFurniture", "checkbox", [
                "label"    => "Наявність меблів",
                "required" => FALSE
            ])
            ->add("hasRegistration", "checkbox", [
                "label"    => "Реєстрація для нерезидентів",
                "required" => FALSE
            ])
        ;
    }
}
