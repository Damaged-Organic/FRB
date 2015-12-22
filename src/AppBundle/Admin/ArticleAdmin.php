<?php
// src/AppBundle/Admin/ArticleAdmin.php
namespace AppBundle\Admin;

use Symfony\Component\Validator\Constraints as Assert;

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
                                    "label" => "Контент",
                                    "constraints" => [
                                        new Assert\Length(['max' => 270, 'maxMessage' => 'Текст новини занадто довгий. Будь ласка, скоротіть його до 270 символів.'])
                                    ]
                                ],
                                "en" => [
                                    "required" => FALSE,
                                    "label"    => "Content",
                                    "constraints" => [
                                        new Assert\Length(['max' => 270])
                                    ]
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
                    'label'         => "Зображення",
                    'required'      => $photoRequired,
                    'allow_delete'  => FALSE,
                    'download_link' => FALSE,
                    'help'          => $photoHelpOption
                ])
            ->end()
        ;
    }

    public function postPersist($article)
    {
        if( !($article instanceof Article) )
            return;

        $this->createThumbnail($article);
    }

    public function postUpdate($article)
    {
        if( !($article instanceof Article) )
            return;

        $rootPath = $this->getConfigurationPool()->getContainer()->get('kernel')->getRootDir() . '/../www';

        if( !file_exists($rootPath . $article->getPhotoThumbPath()) )
            $this->createThumbnail($article);
    }

    protected function createThumbnail($article)
    {
        $filter = 'article_thumb';

        $dataManager   = $this->getConfigurationPool()->getContainer()->get('liip_imagine.data.manager');
        $filterManager = $this->getConfigurationPool()->getContainer()->get('liip_imagine.filter.manager');

        $rootPath = $this->getConfigurationPool()->getContainer()->get('kernel')->getRootDir() . '/../www';

        $imagePath = $article->getPhotoPath();
        $thumbPath = $rootPath . $article->getPhotoThumbPath();

        $image    = $dataManager->find($filter, $imagePath);
        $response = $filterManager->applyFilter($image, $filter);

        $thumb = $response->getContent();

        if( !is_dir(dirname($thumbPath)) )
            mkdir(dirname($thumbPath), '755', TRUE);

        $file = fopen($thumbPath, 'w');
        fwrite($file, $thumb);
        fclose($file);
    }
}
