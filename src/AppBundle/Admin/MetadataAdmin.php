<?php
// src/AppBundle/Admin/MetadataAdmin.php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin,
    Sonata\AdminBundle\Datagrid\ListMapper,
    Sonata\AdminBundle\Datagrid\DatagridMapper,
    Sonata\AdminBundle\Form\FormMapper,
    Sonata\AdminBundle\Route\RouteCollection;

class MetadataAdmin extends Admin
{
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection
            ->remove("create")
            ->remove("delete")
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier("title", "text", [
                "label" => "Заголовок сторінки"
            ])
            ->add("route", "text", [
                "label"    => "Роутер (Системне налаштування)"
            ])
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add("title", "text", [
                "label" => "Заголовок сторінки"
            ])
            ->add("route", "text", [
                "label"    => "Роутер (Системне налаштування)",
                "disabled" => TRUE
            ])
            ->add("description", "textarea", [
                "label"    => "Опис сторінки",
                "required" => FALSE
            ])
            ->add("robots", "text", [
                "label"    => "Метадані для пошукових ботів",
                "required" => FALSE
            ])
            ->end()
            ->with("Локалізації")
                ->add("translations", "a2lix_translations_gedmo", [
                    "label"              => "Керування локалізаціями",
                    "translatable_class" => 'AppBundle\Entity\Metadata',
                    "required"           => TRUE,
                    "fields"             => [
                        "title" => [
                            "locale_options" => [
                                "en" => [
                                    "label" => "Page title"
                                ]
                            ]
                        ],
                        "description" => [
                            "locale_options" => [
                                "en" => [
                                    "label" => "Page description"
                                ]
                            ],
                            "required" => FALSE
                        ]
                    ]
                ])
        ;
    }
}