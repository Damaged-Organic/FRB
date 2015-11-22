<?php
// src/AppBundle/Admin/VacancyListAdmin.php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin,
    Sonata\AdminBundle\Datagrid\ListMapper,
    Sonata\AdminBundle\Datagrid\DatagridMapper,
    Sonata\AdminBundle\Form\FormMapper;

use AppBundle\Entity\VacancyList;

class VacancyListAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add("translations", "a2lix_translations_gedmo", [
                "locales"            => ['ua', 'en'],
                "label"              => "Пункт списку - Локалізований контент",
                "translatable_class" => 'AppBundle\Entity\VacancyList',
                "required"           => TRUE,
                "fields"             => [
                    "listItem" => [
                        "locale_options" => [
                            "ua" => [
                                "label" => "Текст пункта списку"
                            ],
                            "en" => [
                                "required" => FALSE,
                                "label"    => "List item text",
                            ]
                        ]
                    ]
                ]
            ])
        ;
    }
}