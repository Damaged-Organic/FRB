<?php
// src/AppBundle/Admin/ServiceListAdmin.php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin,
    Sonata\AdminBundle\Datagrid\ListMapper,
    Sonata\AdminBundle\Datagrid\DatagridMapper,
    Sonata\AdminBundle\Form\FormMapper,
    Sonata\AdminBundle\Route\RouteCollection;

class ServiceListAdmin extends Admin
{
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection
            ->remove('create')
            ->remove('delete')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add("id", "number", [
                "label" => "ID"
            ])
            ->addIdentifier("title", "text", [
                "label" => "Назва послуги"
            ])
            ->add("service", "text", [
                "label" => "Послуга"
            ])
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add("translations", "a2lix_translations_gedmo", [
                "locales"            => ['ua', 'en'],
                "label"              => "Контент та локалізації",
                "translatable_class" => 'AppBundle\Entity\ServiceList',
                "required"           => FALSE,
                "fields"             => [
                    "title" => [
                        "locale_options" => [
                            "en" => [
                                "label" => "List title"
                            ],
                            "ua" => [
                                "label" => "Назва списку"
                            ]
                        ]
                    ],
                    "shortDescription" => [
                        "locale_options" => [
                            "en" => [
                                "label" => "List short description"
                            ],
                            "ua" => [
                                "label" => "Короткий опис списку"
                            ]
                        ]
                    ]
                ]
            ])
            ->add("serviceListItems", "sonata_type_collection", [
                'by_reference' => FALSE,
                "label"        => FALSE,
            ], [
                'edit' => 'inline',
                'inline' => 'table'
            ])
        ;
    }
}