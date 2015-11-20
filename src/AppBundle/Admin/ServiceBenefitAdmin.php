<?php
// src/AppBundle/Admin/ServiceBenefitAdmin.php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin,
    Sonata\AdminBundle\Datagrid\ListMapper,
    Sonata\AdminBundle\Datagrid\DatagridMapper,
    Sonata\AdminBundle\Form\FormMapper,
    Sonata\AdminBundle\Route\RouteCollection;

class ServiceBenefitAdmin extends Admin
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
            ->add("translations", "a2lix_translations_gedmo", [
                "locales"            => ['ua', 'en'],
                "label"              => "Контент та локалізації",
                "translatable_class" => 'AppBundle\Entity\ServiceBenefit',
                "required"           => FALSE,
                "fields"             => [
                    "thesis" => [
                        "locale_options" => [
                            "en" => [
                                "label" => "Benefit thesis"
                            ],
                            "ua" => [
                                "label" => "Опис переваги"
                            ]
                        ]
                    ]
                ]
            ])
        ;
    }
}