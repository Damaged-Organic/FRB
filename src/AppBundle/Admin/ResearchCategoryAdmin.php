<?php
// src/AppBundle/Admin/ResearchCategoryAdmin.php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin,
    Sonata\AdminBundle\Datagrid\ListMapper,
    Sonata\AdminBundle\Datagrid\DatagridMapper,
    Sonata\AdminBundle\Form\FormMapper;

class ResearchCategoryAdmin extends Admin
{
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add("id", "number", [
                "label" => "ID"
            ])
            ->addIdentifier("title", "text", [
                "label" => "Назва категорії"
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
            ->with("Дослідження - Локалізований контент")
                ->add("translations", "a2lix_translations_gedmo", [
                    "locales"            => ['ua', 'en'],
                    "label"              => FALSE,
                    "translatable_class" => 'AppBundle\Entity\ResearchCategory',
                    "required"           => TRUE,
                    "fields"             => [
                        "title" => [
                            "locale_options" => [
                                "ua" => [
                                    "label" => "Назва категорії"
                                ],
                                "en" => [
                                    "required" => FALSE,
                                    "label"    => "Category title"
                                ]
                            ]
                        ],
                        "description" => [
                            "field_type"     => 'textarea',
                            "locale_options" => [
                                "ua" => [
                                    "label" => "Опис категорії"
                                ],
                                "en" => [
                                    "required" => FALSE,
                                    "label"    => "Category description"
                                ]
                            ]
                        ]
                    ]
                ])
            ->end()
            ->with("Дослідження - Загальні дані")
                ->add('photoFile', 'vich_file', [
                    'label'         => "Зображення",
                    'required'      => $photoRequired,
                    'allow_delete'  => FALSE,
                    'download_link' => FALSE,
                    'help'          => $photoHelpOption
                ])
            ->end()
        ;
    }
}