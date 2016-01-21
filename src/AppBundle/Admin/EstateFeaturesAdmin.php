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
                "label"    => "Безготівковий розрахунок (Non-cash payment)",
                "required" => FALSE
            ])
            ->add("isNewBuilding", "checkbox", [
                "label"    => "Нова будівля (New building)",
                "required" => FALSE
            ])
            ->add("hasElevator", "checkbox", [
                "label"    => "Наявність ліфту (Elevator)",
                "required" => FALSE
            ])
            ->add("hasParking", "checkbox", [
                "label"    => "Наявність парковки (Parking)",
                "required" => FALSE
            ])
            ->add("hasFurniture", "checkbox", [
                "label"    => "Наявність меблів (Furniture)",
                "required" => FALSE
            ])
            ->add("hasRegistration", "checkbox", [
                "label"    => "Реєстрація для нерезидентів (Registration for non-residents)",
                "required" => FALSE
            ])
            ->add("ownerPhysical", "checkbox", [
                "label"    => "Власник - фізична особа (Owner - private person)",
                "required" => FALSE
            ])
            ->add("ownerLegal", "checkbox", [
                "label"    => "Власник - юридична особа (Owner - legal entity)",
                "required" => FALSE
            ])
            ->add("hasSecurity", "checkbox", [
                "label"    => "Косьєрж або охорона (Concierge or security)",
                "required" => FALSE
            ])
            ->add("hasUtility", "checkbox", [
                "label"    => "Комунальні послуги (Utilities)",
                "required" => FALSE
            ])
            ->add("hasCommunications", "checkbox", [
                "label"    => "Заведені комунікації (Communications)",
                "required" => FALSE
            ])
            ->add("hasHeatingSystem", "checkbox", [
                "label"    => "Автономне опалювання (Heating)",
                "required" => FALSE
            ])
            ->add("hasPool", "checkbox", [
                "label"    => "Басейн (Swimming pool)",
                "required" => FALSE
            ])
            ->add("isRenovated", "checkbox", [
                "label"    => "Ремонт (Fit-out)",
                "required" => FALSE
            ])
            ->add("isJustRenovated", "checkbox", [
                "label"    => "Після будівельників (After construction)",
                "required" => FALSE
            ])
            ->add("hasGarage", "checkbox", [
                "label"    => "Гараж (Garage)",
                "required" => FALSE
            ])
            ->add("isOperational", "checkbox", [
                "label"    => "Введено в експлуатацію (Operational)",
                "required" => FALSE
            ])
            ->add("hasBalcony", "checkbox", [
                "label"    => "Балкон (Balcony)",
                "required" => FALSE
            ])
        ;
    }
}
