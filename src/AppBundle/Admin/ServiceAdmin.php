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
            /*$photoRequired = ( $service->getPhotoName() ) ? FALSE : TRUE;

            $photoHelpOption = ( $photoPath = $service->getPhotoPath() )
                ? '<img src="'.$photoPath.'" class="admin-preview" />'
                : FALSE;*/

            $serviceBenefits = $service->getServiceBenefits();
        } else {
            /*$photoRequired   = TRUE;
            $photoHelpOption = FALSE;*/
            $serviceBenefits = FALSE;
        }

        $formMapper
            ->with("Послуга - Локалізований контент")
                ->add("translations", "a2lix_translations_gedmo", [
                    "locales"            => ['ua', 'en'],
                    "label"              => FALSE,
                    "translatable_class" => 'AppBundle\Entity\Service',
                    "required"           => TRUE,
                    "fields"             => [
                        "title" => [
                            "locale_options" => [
                                "ua" => [
                                    "label" => "Назва послуги",
                                ],
                                "en" => [
                                    "required" => FALSE,
                                    "label"    => "Service title"
                                ]
                            ]
                        ],
                        "shortDescription" => [
                            "locale_options" => [
                                "ua" => [
                                    "label" => "Опис послуги"
                                ],
                                "en" => [
                                    "required" => FALSE,
                                    "label"    => "Short description"
                                ]
                            ]
                        ]
                    ]
                ])
            ->end()
            /*->add('photoFile', 'vich_file', [
                'label'         => "Фотографія",
                'required'      => $photoRequired,
                'allow_delete'  => FALSE,
                'download_link' => FALSE,
                'help'          => $photoHelpOption
            ])*/
        ;

        if( count($serviceBenefits) )
        {
            $formMapper
                ->with('Переваги послуги')
                    ->add("serviceBenefits", "sonata_type_collection", [
                        "type_options" => [
                            'delete' => FALSE
                        ],
                        'by_reference' => FALSE,
                        "label"        => FALSE
                    ], [
                        'edit' => 'inline',
                        'inline' => 'table'
                    ])
                ->end()
            ;
        }
    }
}