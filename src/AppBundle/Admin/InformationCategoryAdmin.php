<?php
// src/AppBundle/Admin/InformationCategoryAdmin.php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin,
    Sonata\AdminBundle\Datagrid\ListMapper,
    Sonata\AdminBundle\Datagrid\DatagridMapper,
    Sonata\AdminBundle\Form\FormMapper;

class InformationCategoryAdmin extends Admin
{
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add("id", "number", [
                "label" => "ID"
            ])
            ->addIdentifier("title", "text", [
                "label" => "Назва категорії"
            ])
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add("title", "text", [
                "label" => "Назва категорії"
            ])
            ->end()
            ->with("Локалізації")
            ->add("translations", "a2lix_translations_gedmo", [
                "label"              => "Керування локалізаціями",
                "translatable_class" => 'AppBundle\Entity\ResearchCategory',
                "required"           => TRUE,
                "fields"             => [
                    "title" => [
                        "locale_options" => [
                            "en" => [
                                "label" => "Category title"
                            ]
                        ]
                    ]
                ]
            ])
        ;
    }
}