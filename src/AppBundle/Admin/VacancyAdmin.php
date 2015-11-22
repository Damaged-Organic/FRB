<?php
// src/AppBundle/Admin/VacancyAdmin.php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin,
    Sonata\AdminBundle\Datagrid\ListMapper,
    Sonata\AdminBundle\Datagrid\DatagridMapper,
    Sonata\AdminBundle\Form\FormMapper;

use AppBundle\Entity\Vacancy;

class VacancyAdmin extends Admin
{
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add("id", "number", [
                "label" => "ID"
            ])
            ->addIdentifier("title", "text", [
                "label" => "Вакансія"
            ])
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with("Вакансія - Локалізований контент")
                ->add("translations", "a2lix_translations_gedmo", [
                    "locales"            => ['ua', 'en'],
                    "label"              => FALSE,
                    "translatable_class" => 'AppBundle\Entity\Vacancy',
                    "required"           => TRUE,
                    "fields"             => [
                        "title" => [
                            "locale_options" => [
                                "ua" => [
                                    "label" => "Вакансія"
                                ],
                                "en" => [
                                    "required" => FALSE,
                                    "label"    => "Vacancy"
                                ]
                            ]
                        ],
                        'shortDescription' => [
                            'locale_options' => [
                                'ua' => [
                                    'label'       => 'Короткий опис',
                                    'field_type'  => 'ckeditor',
                                    'config_name' => 'base_config'
                                ],
                                'en' => [
                                    "required"    => FALSE,
                                    'label'       => 'Short Description',
                                    'field_type'  => 'ckeditor',
                                    'config_name' => 'base_config'
                                ]
                            ]
                        ]
                    ]
                ])
            ->end()
            ->with("Вакансія - Загальні дані")
                ->add("publicationDate", "sonata_type_date_picker", [
                    'label' => "Дата розміщення"
                ])
                ->add("isActive", "checkbox", [
                    'required' => FALSE,
                    'label'    => "Відображати на сайті"
                ])
            ->end()
            ->with("Вимоги до кандидатів")
                ->add("listRequirements", "sonata_type_collection", [
                    'by_reference' => FALSE,
                    "label"        => FALSE,
                    "btn_add"      => "Додати вимогу"
                ], [
                    'edit' => 'inline',
                    'inline' => 'table'
                ])
            ->end()
            ->with("Основні завдання")
                ->add("listTasks", "sonata_type_collection", [
                    'by_reference' => FALSE,
                    "label"        => FALSE,
                    "btn_add"      => "Додати завдання"
                ], [
                    'edit' => 'inline',
                    'inline' => 'table'
                ])
            ->end()
            ->with("Буде перевагою")
                ->add("listAdvantages", "sonata_type_collection", [
                    'by_reference' => FALSE,
                    "label"        => FALSE,
                    "btn_add"      => "Додати перевагу"
                ], [
                    'edit' => 'inline',
                    'inline' => 'table'
                ])
            ->end()
        ;
    }
}