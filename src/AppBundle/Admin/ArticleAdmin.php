<?php
// src/AppBundle/Admin/ArticleAdmin.php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin,
    Sonata\AdminBundle\Datagrid\ListMapper,
    Sonata\AdminBundle\Datagrid\DatagridMapper,
    Sonata\AdminBundle\Form\FormMapper;

use AppBundle\Entity\Article;

class ArticleAdmin extends Admin
{
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add("id", "number", [
                "label" => "ID"
            ])
            ->addIdentifier("title", "text", [
                "label" => "Заголовок"
            ])
            ->add("publicationDate", "date", [
                'label' => "Дата публікації"
            ])
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add("title", "text", [
                "label" => "Заголовок"
            ])
            ->add("publicationDate", "sonata_type_date_picker", [
                'label' => "Дата публікації"
            ])
            ->add("content", "textarea", [
                "label" => "Контент"
            ])
            ->end()
            ->with("Локалізації")
                ->add("translations", "a2lix_translations_gedmo", [
                    "label"              => "Керування локалізаціями",
                    "translatable_class" => 'AppBundle\Entity\Article',
                    "required"           => TRUE,
                    "fields"             => [
                        "title" => [
                            "locale_options" => [
                                "en" => [
                                    "label" => "Headline"
                                ]
                            ]
                        ],
                        "content" => [
                            "locale_options" => [
                                "en" => [
                                    "label" => "Content"
                                ]
                            ]
                        ]
                    ]
                ])
        ;
    }
}