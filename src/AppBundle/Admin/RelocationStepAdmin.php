<?php
// src/AppBundle/Admin/RelocationStepAdmin.php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin,
    Sonata\AdminBundle\Datagrid\ListMapper,
    Sonata\AdminBundle\Datagrid\DatagridMapper,
    Sonata\AdminBundle\Form\FormMapper,
    Sonata\AdminBundle\Route\RouteCollection;

class RelocationStepAdmin extends Admin
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
            ->add("id", "number", [
                "label" => "ID"
            ])
            ->addIdentifier("title", "text", [
                "label" => "Назва кроку"
            ])
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        if( $relocationStep = $this->getSubject() ){
            $fileHelpOptionUA = ( $relocationStep->getFileNameUA() ) ?: FALSE;
            $fileHelpOptionEN = ( $relocationStep->getFileNameEN() ) ?: FALSE;
        } else {
            $fileHelpOptionUA = FALSE;
            $fileHelpOptionEN = FALSE;
        }

        $formMapper
            ->with("Релокація експатів - Локалізований контент")
                ->add("translations", "a2lix_translations_gedmo", [
                    "locales"            => ['ua', 'en'],
                    "label"              => FALSE,
                    "translatable_class" => 'AppBundle\Entity\RelocationStep',
                    "required"           => TRUE,
                    "fields"             => [
                        "title" => [
                            "locale_options" => [
                                "ua" => [
                                    "label" => "Назва кроку",
                                ],
                                "en" => [
                                    "required" => FALSE,
                                    "label"    => "Step title"
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
            ->end()
            ->with("Пункти списку")
                ->add("relocationStepItems", "sonata_type_collection", [
                    'by_reference' => FALSE,
                    "label"        => FALSE,
                    "btn_add"      => "Додати пункт списку"
                ], [
                    'edit' => 'inline',
                    'inline' => 'table'
                ])
            ->end()
        ;
    }
}
