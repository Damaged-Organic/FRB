<?php
// src/AppBundle/Admin/EstateAttributeAdmin.php
namespace AppBundle\Admin;

use Symfony\Component\Validator\Constraints as Assert;

use Sonata\AdminBundle\Admin\Admin,
    Sonata\AdminBundle\Datagrid\ListMapper,
    Sonata\AdminBundle\Datagrid\DatagridMapper,
    Sonata\AdminBundle\Form\FormMapper;

use AppBundle\Entity\EstateAttribute;

class EstateAttributeAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('estateAttributeType', 'entity', [
                'class' => 'AppBundle\Entity\EstateAttributeType',
                'label' => 'Характеристика'
            ])
            ->add('value', 'text', [
                'label' => 'Значення характеристики'
            ])
        ;
    }
}