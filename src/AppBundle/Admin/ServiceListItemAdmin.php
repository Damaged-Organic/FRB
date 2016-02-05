<?php
// src/AppBundle/Admin/ServiceListItemAdmin.php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin,
    Sonata\AdminBundle\Datagrid\ListMapper,
    Sonata\AdminBundle\Datagrid\DatagridMapper,
    Sonata\AdminBundle\Form\FormMapper,
    Sonata\AdminBundle\Route\RouteCollection;

class ServiceListItemAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        if( $serviceListItem = $this->getSubject() ){
            $fileHelpOptionUA = ( $serviceListItem->getFileNameUA() ) ?: FALSE;
            $fileHelpOptionEN = ( $serviceListItem->getFileNameEN() ) ?: FALSE;
        } else {
            $fileHelpOptionUA = FALSE;
            $fileHelpOptionEN = FALSE;
        }

        $formMapper
            ->add("translations", "a2lix_translations_gedmo", [
                "locales"            => ['ua', 'en'],
                "label"              => "Пункт списку - Локалізований контент",
                "translatable_class" => 'AppBundle\Entity\ServiceListItem',
                "required"           => TRUE,
                "fields"             => [
                    "text" => [
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
            ->add('fileUA', 'vich_file', [
                'label'         => "Документ (UA)",
                'required'      => FALSE,
                'allow_delete'  => TRUE,
                'download_link' => TRUE,
                'help'          => $fileHelpOptionUA
            ])
            ->add('fileEN', 'vich_file', [
                'label'         => "Документ (EN)",
                'required'      => FALSE,
                'allow_delete'  => TRUE,
                'download_link' => TRUE,
                'help'          => $fileHelpOptionEN
            ])
        ;
    }
}
