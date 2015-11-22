<?php
// src/AppBundle/Admin/ArticleAdmin.php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin,
    Sonata\AdminBundle\Datagrid\ListMapper,
    Sonata\AdminBundle\Datagrid\DatagridMapper,
    Sonata\AdminBundle\Form\FormMapper;

use AppBundle\Entity\Article;

class ArticleAdmin extends Admin
{
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add("id", "number", [
                "label" => "ID"
            ])
            ->addIdentifier("title", "text", [
                "label" => "Заголовок"
            ])
            ->add("publicationDate", "date", [
                'label' => "Дата публікації"
            ])
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        if( $article = $this->getSubject() )
        {
            $photoRequired = ( $article->getPhotoName() ) ? FALSE : TRUE;

            $photoHelpOption = ( $photoPath = $article->getPhotoPath() )
                ? '<img src="'.$photoPath.'" class="admin-preview" />'
                : FALSE;
        } else {
            $photoRequired   = TRUE;
            $photoHelpOption = FALSE;
        }

        $formMapper
            ->with("Новина - Локалізований контент")
                ->add("translations", "a2lix_translations_gedmo", [
                    "locales"            => ['ua', 'en'],
                    "label"              => FALSE,
                    "translatable_class" => 'AppBundle\Entity\Article',
                    "required"           => TRUE,
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
                        "content" => [
                            "locale_options" => [
                                "ua" => [
                                    "label" => "Контент"
                                ],
                                "en" => [
                                    "required" => FALSE,
                                    "label"    => "Content"
                                ]
                            ]
                        ]
                    ]
                ])
            ->end()
            ->with("Новина - Загальні дані")
                ->add("publicationDate", "sonata_type_date_picker", [
                    'label' => "Дата публікації"
                ])
                ->add('photoFile', 'vich_file', [
                    'label'         => "Фотографія",
                    'required'      => $photoRequired,
                    'allow_delete'  => FALSE,
                    'download_link' => FALSE,
                    'help'          => $photoHelpOption
                ])
            ->end()
        ;
    }
}