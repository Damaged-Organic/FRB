<?php
// src/AppBundle/Admin/InformationAdmin.php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin,
    Sonata\AdminBundle\Datagrid\ListMapper,
    Sonata\AdminBundle\Datagrid\DatagridMapper,
    Sonata\AdminBundle\Form\FormMapper;

use AppBundle\Entity\Repository\InformationCategoryRepository,
    AppBundle\Entity\Information;

class InformationAdmin extends Admin
{
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add("id", "number", [
                "label" => "ID"
            ])
            ->addIdentifier("title", "text", [
                "label" => "Назва пункту"
            ])
            ->add("informationCategory", "text", [
                "label" => "Категорія"
            ])
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        if ( $information = $this->getSubject() )
        {
            $logoRequired = ( $information->getLogoName() ) ? FALSE : TRUE;

            $logoHelpOption = ( $logoPath = $information->getLogoPath() )
                ? '<img src="' . $logoPath . '" class="admin-preview" />'
                : FALSE;

            /*$photoRequired = ( $information->getPhotoName() ) ? FALSE : TRUE;

            $photoHelpOption = ( $photoPath = $information->getPhotoPath() )
                ? '<img src="' . $photoPath . '" class="admin-preview" />'
                : FALSE;*/
        } else {
            $logoRequired   = TRUE;
            $logoHelpOption = FALSE;
            /*$photoRequired   = TRUE;
            $photoHelpOption = FALSE;*/
        }

        $formMapper
            ->with("Інформація - Локалізований контент")
                ->add("translations", "a2lix_translations_gedmo", [
                    "locales"            => ['ua', 'en'],
                    "label"              => FALSE,
                    "translatable_class" => 'AppBundle\Entity\Information',
                    "required"           => TRUE,
                    "fields"             => [
                        "title" => [
                            "locale_options" => [
                                "ua" => [
                                    "label" => "Назва пункту"
                                ],
                                "en" => [
                                    "required" => FALSE,
                                    "label"    => "Item name"
                                ]
                            ]
                        ],
                        'description' => [
                            'locale_options' => [
                                'ua' => [
                                    'label' => 'Опис'
                                ],
                                'en' => [
                                    "required" => FALSE,
                                    'label' => 'Description'
                                ]
                            ]
                        ],
                        'addresses' => [
                            'locale_options' => [
                                'ua' => [
                                    'label' => 'Адреси - введіть адреси по одній у рядок (через Enter)'
                                ],
                                'en' => [
                                    "required" => FALSE,
                                    'label' => 'Addresses - enter each address on a new line'
                                ]
                            ]
                        ]
                    ]
                ])
            ->end()
            ->with("Інформація - Загальні дані")
                ->add('informationCategory','entity', [
                    'class'         => 'AppBundle:InformationCategory',
                    'query_builder' => function(InformationCategoryRepository $repository) { return $repository->createQueryBuilder('c')->orderBy('c.id', 'ASC'); },
                    'property'      => 'title',
                    'label'         => 'Категорія',
                    'empty_value'   => 'Оберіть категорію...'
                ])
                ->add('logoFile', 'vich_file', [
                    'label'         => "Логотип",
                    'required'      => $logoRequired,
                    'allow_delete'  => FALSE,
                    'download_link' => FALSE,
                    'help'          => $logoHelpOption
                ])
                /*->add('photoFile', 'vich_file', [
                    'label'         => "Фотографія",
                    'required'      => $photoRequired,
                    'allow_delete'  => FALSE,
                    'download_link' => FALSE,
                    'help'          => $logoHelpOption
                ])*/
                ->add("link", "text", [
                    'label' => "Посилання"
                ])
                ->add("emails", "textarea", [
                    'label'    => "Електронна пошта",
                    'required' => FALSE,
                    'help'     => "Введіть електронні адреси по одній у рядок (через Enter)"
                ])
                ->add("phones", "textarea", [
                    'label'    => "Телефони",
                    'required' => FALSE,
                    'help'     => "Введіть телефони по одному у рядок (через Enter)"
                ])
            ->end()
        ;
    }

    public function preUpdate($information)
    {
        if( !($information instanceof Information) )
            return;

        if( !($information->getAddresses()) )
            return;

        $geoCoder = $this->getConfigurationPool()->getContainer()->get('app.geo_coder');

        $addresses = explode(PHP_EOL, $information->getAddresses());

        $coordinates = [];

        foreach($addresses as $address)
        {
            $coordinates[] = $geoCoder->getCoordinates($address);
        }

        if( $coordinates )
            $information->setCoordinates($coordinates);
    }
}