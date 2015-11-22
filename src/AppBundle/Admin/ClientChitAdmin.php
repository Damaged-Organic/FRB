<?php
// src/AppBundle/Admin/ClientChitAdmin.php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin,
    Sonata\AdminBundle\Datagrid\ListMapper,
    Sonata\AdminBundle\Datagrid\DatagridMapper,
    Sonata\AdminBundle\Form\FormMapper;

use AppBundle\Entity\ClientChit;

class ClientChitAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add("translations", "a2lix_translations_gedmo", [
                "locales"            => ['ua', 'en'],
                "label"              => "Відгук клієнта - Локалізований контент",
                "translatable_class" => 'AppBundle\Entity\ClientChit',
                "required"           => FALSE,
                "fields"             => [
                    "text" => [
                        "field_type"     => 'textarea',
                        "locale_options" => [
                            "ua" => [
                                "label" => "Текст відгуку"
                            ],
                            "en" => [
                                "label" => "Message text"
                            ]
                        ]
                    ]
                ]
            ])
            ->add("isActive", "checkbox", [
                "required" => FALSE,
                "label"    => "Відображати на сайті"
            ])
        ;
    }
}