<?php
// src/AppBundle/Admin/ContactAdmin.php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin,
    Sonata\AdminBundle\Datagrid\ListMapper,
    Sonata\AdminBundle\Datagrid\DatagridMapper,
    Sonata\AdminBundle\Form\FormMapper,
    Sonata\AdminBundle\Route\RouteCollection;

class ContactAdmin extends Admin
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
            ->addIdentifier("address", "text", [
                "label" => "Адреса"
            ])
            ->add("phone", "text", [
                "label" => "Телефон"
            ])
            ->add("fax", "text", [
                "label" => "Факс"
            ])
            ->add("email", "text", [
                "label" => "E-mail"
            ])
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        if( $research = $this->getSubject() ){
            $pdfPreviewRequiredUA   = ( $research->getPdfPreviewNameUA() ) ? FALSE : TRUE;
            $pdfPreviewHelpOptionUA = ( $research->getPdfPreviewNameUA() ) ?: FALSE;

            $pdfPreviewHelpOptionEN = ( $research->getPdfPreviewNameEN() ) ?: FALSE;
        } else {
            $pdfPreviewRequiredUA   = TRUE;
            $pdfPreviewHelpOptionUA = FALSE;

            $pdfPreviewHelpOptionEN = FALSE;
        }

        $formMapper
            ->with("Контакти - Загальні дані")
                ->add("phone", "text", [
                    "label" => "Телефон"
                ])
                ->add("fax", "text", [
                    "label" => "Факс"
                ])
                ->add("email", "text", [
                    "label" => "E-mail"
                ])
                ->add('pdfPreviewFileUA', 'vich_file', [
                    'label'         => "PDF файл зі схемою проїзду (UA)",
                    'required'      => $pdfPreviewRequiredUA,
                    'allow_delete'  => FALSE,
                    'download_link' => TRUE,
                    'help'          => $pdfPreviewHelpOptionUA
                ])
                ->add('pdfPreviewFileEN', 'vich_file', [
                    'label'         => "PDF файл зі схемою проїзду (EN)",
                    'required'      => FALSE,
                    'allow_delete'  => FALSE,
                    'download_link' => TRUE,
                    'help'          => $pdfPreviewHelpOptionEN
                ])
            ->end()
            ->with("Контакти / Про компанію - Локалізований контент")
                ->add("translations", "a2lix_translations_gedmo", [
                    "locales"            => ['ua', 'en'],
                    "label"              => FALSE,
                    "translatable_class" => 'AppBundle\Entity\Contact',
                    "required"           => TRUE,
                    "fields"             => [
                        "address" => [
                            "locale_options" => [
                                "ua" => [
                                    "label" => "Адреса"
                                ],
                                "en" => [
                                    "required" => FALSE,
                                    "label"    => "Address"
                                ]
                            ]
                        ],
                        "headline" => [
                            "locale_options" => [
                                "ua" => [
                                    "label" => "Про компанію - Заголовок"
                                ],
                                "en" => [
                                    "required" => FALSE,
                                    "label"    => "About company - List"
                                ]
                            ]
                        ],
                        "intro" => [
                            "locale_options" => [
                                'ua' => [
                                    'label'       => 'Про компанію - Вступ',
                                    'field_type'  => 'ckeditor',
                                    'config_name' => 'base_config'
                                ],
                                'en' => [
                                    "required"    => FALSE,
                                    'label'       => 'About company - Intro',
                                    'field_type'  => 'ckeditor',
                                    'config_name' => 'base_config'
                                ]
                            ]
                        ],
                        "list" => [
                            "locale_options" => [
                                "ua" => [
                                    "label" => "Про компанію - Список - введіть по одному пункту у рядок (через Enter)"
                                ],
                                "en" => [
                                    "required" => FALSE,
                                    "label"    => "About company - List - enter each item on a new line"
                                ]
                            ]
                        ],
                        "outro" => [
                            "locale_options" => [
                                'ua' => [
                                    'label'       => 'Про компанію - Заключення',
                                    'field_type'  => 'ckeditor',
                                    'config_name' => 'base_config'
                                ],
                                'en' => [
                                    "required"    => FALSE,
                                    'label'       => 'About company - Outro',
                                    'field_type'  => 'ckeditor',
                                    'config_name' => 'base_config'
                                ]
                            ]
                        ]
                    ]
                ])
            ->end()
        ;
    }
}
