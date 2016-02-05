<?php
// src/AppBundle/Admin/EstatePhotoAdmin.php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin,
    Sonata\AdminBundle\Datagrid\ListMapper,
    Sonata\AdminBundle\Datagrid\DatagridMapper,
    Sonata\AdminBundle\Form\FormMapper;

class EstatePhotoAdmin extends Admin
{
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier("id", "number", [
                "label" => "ID"
            ])
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $photoPathData = ( ($estatePhoto = $this->getSubject()) && ($photoPath = $estatePhoto->getPhotoPath()) )
            ? $photoPath
            : FALSE;

        $formMapper
            ->add('photoPath', 'text', [
                'label'     => "Ім’я файлу",
                'required'  => FALSE,
                'mapped'    => FALSE,
                'read_only' => TRUE,
                'data'      => $photoPathData,
                'attr' => [
                    'hidden' => TRUE
                ]
            ])
            ->add('photoFile', 'file', [
                'label'    => "Додати файл",
                'required' => !$photoPathData
            ])
        ;
    }
}
