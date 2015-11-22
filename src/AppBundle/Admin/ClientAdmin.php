<?php
// src/AppBundle/Admin/ClientAdmin.php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin,
    Sonata\AdminBundle\Datagrid\ListMapper,
    Sonata\AdminBundle\Datagrid\DatagridMapper,
    Sonata\AdminBundle\Form\FormMapper;

use AppBundle\Entity\Client;

class ClientAdmin extends Admin
{
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add("id", "number", [
                "label" => "ID"
            ])
            ->addIdentifier("name", "text", [
                "label" => "Назва компанії"
            ])
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        if( $client = $this->getSubject() )
        {
            $logoRequired = ( $client->getLogoName() ) ? FALSE : TRUE;

            $logoHelpOption = ( $logoPath = $client->getLogoPath() )
                ? '<img src="'.$logoPath.'" class="admin-preview" />'
                : FALSE;
        } else {
            $logoRequired   = TRUE;
            $logoHelpOption = FALSE;
        }

        $formMapper
            ->with("Клієнт - Локалізований контент")
                ->add("translations", "a2lix_translations_gedmo", [
                    "locales"            => ['ua', 'en'],
                    "label"              => FALSE,
                    "translatable_class" => 'AppBundle\Entity\Client',
                    "required"           => FALSE,
                    "fields"             => [
                        "name" => [
                            "locale_options" => [
                                "ua" => [
                                    "label" => "Назва компанії"
                                ],
                                "en" => [
                                    "label" => "Company name"
                                ]
                            ]
                        ]
                    ]
                ])
            ->end()
            ->with("Клієнт - Загальні дані")
                ->add('logoFile', 'vich_file', [
                    'label'         => "Фотографія",
                    'required'      => $logoRequired,
                    'allow_delete'  => FALSE,
                    'download_link' => FALSE,
                    'help'          => $logoHelpOption
                ])
            ->end()
            ->with('Відгуки клієнтів')
                ->add("clientChits", "sonata_type_collection", [
                    'by_reference' => FALSE,
                    "label"        => FALSE,
                    "btn_add"      => "Додати відгук"
                ], [
                    'edit' => 'inline',
                    'inline' => 'table'
                ])
            ->end()
        ;
    }
}