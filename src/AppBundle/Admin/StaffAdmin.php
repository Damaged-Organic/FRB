<?php
// src/AppBundle/Admin/StaffAdmin.php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin,
    Sonata\AdminBundle\Datagrid\ListMapper,
    Sonata\AdminBundle\Datagrid\DatagridMapper,
    Sonata\AdminBundle\Form\FormMapper;

class StaffAdmin extends Admin
{
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add("id", "number", [
                "label" => "ID"
            ])
            ->addIdentifier("name", "text", [
                "label" => "Ім’я співробітника"
            ])
            ->add("phone", "text", [
                "label" => "Номер телефону"
            ])
            ->add("email", "text", [
                "label" => "E-mail"
            ])
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        if( $staff = $this->getSubject() )
        {
            $photoRequired = ( $staff->getPhotoName() ) ? FALSE : TRUE;

            $photoHelpOption = ( $photoPath = $staff->getPhotoPath() )
                ? '<img src="'.$photoPath.'" class="admin-preview" />'
                : FALSE;
        } else {
            $photoRequired   = TRUE;
            $photoHelpOption = FALSE;
        }

        $formMapper
            ->with("Співробітник - Локалізований контент")
                ->add("translations", "a2lix_translations_gedmo", [
                    "locales"            => ['ua', 'en'],
                    "label"              => FALSE,
                    "translatable_class" => 'AppBundle\Entity\Staff',
                    "required"           => TRUE,
                    "fields"             => [
                        "name" => [
                            "locale_options" => [
                                "ua" => [
                                    "label" => "ПІБ"
                                ],
                                "en" => [
                                    "required" => FALSE,
                                    "label"    => "Full name"
                                ]
                            ]
                        ],
                        "position" => [
                            "locale_options" => [
                                "ua" => [
                                    "label" => "Посада"
                                ],
                                "en" => [
                                    "required" => FALSE,
                                    "label"    => "Position"
                                ]
                            ]
                        ],
                        /*"education" => [
                            'required'       => FALSE,
                            "locale_options" => [
                                "ua" => [
                                    "label" => "Освіта"
                                ],
                                "en" => [
                                    "label" => "Education"
                                ]
                            ]
                        ],*/
                        /*"degree" => [
                            'required'       => FALSE,
                            "locale_options" => [
                                "ua" => [
                                    "label" => "Наукова ступінь"
                                ],
                                "en" => [
                                    "label" => "Degree"
                                ]
                            ]
                        ]*/
                    ]
                ])
            ->end()
            ->with("Співробітник - Загальні дані")
                ->add("phone", "text", [
                    "label" => "Телефон"
                ])
                ->add("email", "text", [
                    "label" => "E-mail"
                ])
                ->add("skype", "text", [
                    "required" => FALSE,
                    "label"    => "Skype"
                ])
                ->add('photoFile', 'vich_file', [
                    'label'         => "Фотографія",
                    'required'      => $photoRequired,
                    'allow_delete'  => FALSE,
                    'download_link' => FALSE,
                    'help'          => $photoHelpOption
                ])
                ->add("services", "collection", [
                    'required'     => TRUE,
                    'type'         => 'entity',
                    'allow_add'    => TRUE,
                    'allow_delete' => TRUE,
                    'by_reference' => FALSE,
                    'label'        => "Відділи",
                    'options' => [
                        'class'    => 'AppBundle:Service',
                        'property' => 'title',
                        'label'    => FALSE,
                    ]
                ])
            ->end()
        ;
    }
}