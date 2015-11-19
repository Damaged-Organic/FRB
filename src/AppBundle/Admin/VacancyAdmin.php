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
            ->add("title", "text", [
                "label" => "Вакансія"
            ])
            ->add("requirements", "sonata_formatter_type", [
                "label"                => "Вимоги",
                "event_dispatcher"     => $formMapper->getFormBuilder()->getEventDispatcher(),
                "format_field"         => "requirementsFormatter",
                "source_field"         => "rawRequirements",
                "ckeditor_context"     => "extended_config",
                "source_field_options" => [
                    "attr" => [
                        "class" => "span10", "rows" => 10
                    ]
                ],
                "listener"     => TRUE,
                "target_field" => "requirements"
            ])
            ->add("additional", "sonata_formatter_type", [
                'required'             => FALSE,
                "label"                => "Додатково",
                "event_dispatcher"     => $formMapper->getFormBuilder()->getEventDispatcher(),
                "format_field"         => "additionalFormatter",
                "source_field"         => "rawAdditional",
                "ckeditor_context"     => "extended_config",
                "source_field_options" => [
                    "attr" => [
                        "class" => "span10", "rows" => 10
                    ]
                ],
                "listener"     => TRUE,
                "target_field" => "additional"
            ])
            ->add("isActive", "checkbox", [
                'required' => FALSE,
                'label'    => "Відображати"
            ])
            ->end()
            ->with("Локалізації")
                ->add("translations", "a2lix_translations_gedmo", [
                    "label"              => "Керування локалізаціями",
                    "translatable_class" => 'AppBundle\Entity\Vacancy',
                    "required"           => TRUE,
                    "fields"             => [
                        "title" => [
                            "locale_options" => [
                                "en" => [
                                    "label" => "Vacancy"
                                ]
                            ]
                        ],
                        'requirements' => [
                            'locale_options' => [
                                'en' => [
                                    'label'       => 'Requirements',
                                    'field_type'  => 'ckeditor',
                                    'config_name' => 'extended_config'
                                ]
                            ]
                        ],
                        'additional' => [
                            'required'       => FALSE,
                            'locale_options' => [
                                'en' => [
                                    'label'       => 'Additional',
                                    'field_type'  => 'ckeditor',
                                    'config_name' => 'extended_config'
                                ]
                            ]
                        ]
                    ]
                ])
        ;
    }
}