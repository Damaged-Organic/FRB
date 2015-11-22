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
            ->with("Новина - Локалізований контент")
                ->add("translations", "a2lix_translations_gedmo", [
                    "locales"            => ['ua', 'en'],
                    "label"              => FALSE,
                    "translatable_class" => 'AppBundle\Entity\Article',
                    "required"           => TRUE,
                    "fields"             => [
                        "title" => [
                            "locale_options" => [
                                "ua" => [
                                    "label" => "Заголовок"
                                ],
                                "en" => [
                                    "label" => "Headline"
                                ]
                            ]
                        ],
                        "content" => [
                            "locale_options" => [
                                "ua" => [
                                    "label" => "Контент"
                                ],
                                "en" => [
                                    "label" => "Content"
                                ]
                            ]
                        ]
                    ]
                ])
            ->end()
            ->with("Новина - Загальні дані")
                ->add("publicationDate", "sonata_type_date_picker", [
                    'label' => "Дата публікації"
                ])
            ->end()
        ;
    }
}