<?php
// src/AppBundle/Admin/ServiceListItemAdmin.php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin,
    Sonata\AdminBundle\Datagrid\ListMapper,
    Sonata\AdminBundle\Datagrid\DatagridMapper,
    Sonata\AdminBundle\Form\FormMapper,
    Sonata\AdminBundle\Route\RouteCollection;

class ServiceListItemAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add("translations", "a2lix_translations_gedmo", [
                "locales"            => ['ua', 'en'],
                "label"              => "Контент та локалізації",
                "translatable_class" => 'AppBundle\Entity\ServiceListItem',
                "required"           => FALSE,
                "fields"             => [
                    "text" => [
                        "locale_options" => [
                            "en" => [
                                "label" => "List item text",
                            ],
                            "ua" => [
                                "label" => "Текст пункта списку"
                            ]
                        ]
                    ]
                ]
            ])
        ;
    }
}