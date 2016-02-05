<?php
// src/AppBundle/Admin/InformationIntroAdmin.php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin,
    Sonata\AdminBundle\Datagrid\ListMapper,
    Sonata\AdminBundle\Datagrid\DatagridMapper,
    Sonata\AdminBundle\Form\FormMapper,
    Sonata\AdminBundle\Route\RouteCollection;

use AppBundle\Entity\InformationIntro;

class InformationIntroAdmin extends Admin
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
            ->addIdentifier("title", "text", [
                "label" => "Заголовок"
            ])
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        if( $informationIntro = $this->getSubject() ){
            $fileHelpOptionUA = ( $informationIntro->getFileNameUA() ) ?: FALSE;
            $fileHelpOptionEN = ( $informationIntro->getFileNameEN() ) ?: FALSE;
        } else {
            $fileHelpOptionUA = FALSE;
            $fileHelpOptionEN = FALSE;
        }

        $formMapper
            ->add("translations", "a2lix_translations_gedmo", [
                "locales"            => ['ua', 'en'],
                "label"              => "Текст інформації для експатів - Локалізований контент",
                "translatable_class" => 'AppBundle\Entity\InformationIntro',
                "required"           => FALSE,
                "fields"             => [
                    "title" => [
                        "locale_options" => [
                            "ua" => [
                                "label" => "Заголовок"
                            ],
                            "en" => [
                                "required" => FALSE,
                                "label"    => "Headline"
                            ]
                        ]
                    ],
                    "text" => [
                        "field_type"     => 'textarea',
                        "locale_options" => [
                            "ua" => [
                                "label" => "Текст"
                            ],
                            "en" => [
                                "required" => FALSE,
                                "label"    => "Text"
                            ]
                        ]
                    ]
                ]
            ])
            ->add('fileUA', 'vich_file', [
                'label'         => "Путівник для експатів (UA)",
                'required'      => FALSE,
                'allow_delete'  => TRUE,
                'download_link' => TRUE,
                'help'          => $fileHelpOptionUA
            ])
            ->add('fileEN', 'vich_file', [
                'label'         => "Guidebook for expats (EN)",
                'required'      => FALSE,
                'allow_delete'  => TRUE,
                'download_link' => TRUE,
                'help'          => $fileHelpOptionEN
            ])
        ;
    }
}
