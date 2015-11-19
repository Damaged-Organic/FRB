<?php
// src/AppBundle/Admin/ServiceAdmin.php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin,
    Sonata\AdminBundle\Datagrid\ListMapper,
    Sonata\AdminBundle\Datagrid\DatagridMapper,
    Sonata\AdminBundle\Form\FormMapper,
    Sonata\AdminBundle\Route\RouteCollection;

class ServiceAdmin extends Admin
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
                "label" => "Назва послуги"
            ])
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        if( $service = $this->getSubject() )
        {
            $photoRequired = ( $service->getPhotoName() ) ? FALSE : TRUE;

            $photoHelpOption = ( $photoPath = $service->getPhotoPath() )
                ? '<img src="'.$photoPath.'" class="admin-preview" />'
                : FALSE;
        } else {
            $photoRequired   = TRUE;
            $photoHelpOption = FALSE;
        }

        $formMapper
            ->add("title", "text", [
                "label" => "Назва послуги"
            ])
            ->add("shortDescription", "textarea", [
                "label" => "Короткий опис"
            ])
            ->add('photoFile', 'vich_file', [
                'label'         => "Фотографія",
                'required'      => $photoRequired,
                'allow_delete'  => FALSE,
                'download_link' => FALSE,
                'help'          => $photoHelpOption
            ])
            ->end()
            ->with("Локалізації")
                ->add("translations", "a2lix_translations_gedmo", [
                    "label"              => "Керування локалізаціями",
                    "translatable_class" => 'AppBundle\Entity\Service',
                    "required"           => TRUE,
                    "fields"             => [
                        "title" => [
                            "locale_options" => [
                                "en" => [
                                    "label" => "Service title"
                                ]
                            ]
                        ],
                        "shortDescription" => [
                            "locale_options" => [
                                "en" => [
                                    "label" => "Short description"
                                ]
                            ]
                        ]
                    ]
                ])
        ;
    }
}