<?php
// src/AppBundle/Admin/InformationAdmin.php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin,
    Sonata\AdminBundle\Datagrid\ListMapper,
    Sonata\AdminBundle\Datagrid\DatagridMapper,
    Sonata\AdminBundle\Form\FormMapper;

use AppBundle\Entity\Repository\InformationCategoryRepository;

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
        if ( $information = $this->getSubject() ) {
            $logoHelpOption = ( $logoPath = $information->getLogoPath() )
                ? '<img src="' . $logoPath . '" class="admin-preview" />'
                : FALSE;

            $photoHelpOption = ( $photoPath = $information->getPhotoPath() )
                ? '<img src="' . $photoPath . '" class="admin-preview" />'
                : FALSE;
        } else {
            $logoHelpOption  = FALSE;
            $photoHelpOption = FALSE;
        }

        $formMapper
            ->add("title", "text", [
                "label" => "Назва пункту"
            ])
            ->add('informationCategory','entity', [
                'class'         => 'AppBundle:InformationCategory',
                'query_builder' => function(InformationCategoryRepository $repository) { return $repository->createQueryBuilder('c')->orderBy('c.id', 'ASC'); },
                'property'      => 'title',
                'label'         => 'Категорія',
                'empty_value'   => 'Оберіть категорію...'
            ])
            ->add("description", "textarea", [
                "label" => "Опис"
            ])
            ->add('logoFile', 'vich_file', [
                'label'         => "Логотип",
                'required'      => FALSE,
                'allow_delete'  => TRUE,
                'download_link' => FALSE,
                'help'          => $logoHelpOption
            ])
            ->add('photoFile', 'vich_file', [
                'label'         => "Фотографія",
                'required'      => FALSE,
                'allow_delete'  => TRUE,
                'download_link' => FALSE,
                'help'          => $logoHelpOption
            ])
            ->add("link", "text", [
                'label' => "Посилання"
            ])
            ->add("emails", "textarea", [
                'label'    => "Електронна пошта",
                'required' => FALSE,
                'help'     => "Введіть електронні адреси по одній у рядок"
            ])
            ->add("phones", "textarea", [
                'label'    => "Телефони",
                'required' => FALSE,
                'help'     => "Введіть телефони по одній у рядок"
            ])
            ->add("addresses", "textarea", [
                'label'    => "Адреси",
                'required' => FALSE,
                'help'     => "Введіть адреси по одній у рядок"
            ])
        ;
    }
}