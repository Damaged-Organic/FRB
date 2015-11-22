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
            ->with("Список послуг - Локалізований контент")
                ->add("translations", "a2lix_translations_gedmo", [
                    "locales"            => ['ua', 'en'],
                    "label"              => FALSE,
                    "translatable_class" => 'AppBundle\Entity\ServiceList',
                    "required"           => TRUE,
                    "fields"             => [
                        "title" => [
                            "locale_options" => [
                                "ua" => [
                                    "label" => "Назва списку"
                                ],
                                "en" => [
                                    "required" => FALSE,
                                    "label"    => "List title"
                                ]
                            ]
                        ],
                        "shortDescription" => [
                            "locale_options" => [
                                "ua" => [
                                    "label" => "Короткий опис списку"
                                ],
                                "en" => [
                                    "required" => FALSE,
                                    "label"    => "List short description"
                                ]
                            ]
                        ]
                    ]
                ])
            ->end()
            ->with("Пункти списку")
                ->add("serviceListItems", "sonata_type_collection", [
                    'by_reference' => FALSE,
                    "label"        => FALSE,
                    "btn_add"      => "Додати послугу"
                ], [
                    'edit' => 'inline',
                    'inline' => 'table'
                ])
            ->end()
        ;
    }
}