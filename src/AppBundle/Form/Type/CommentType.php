<?php
// src/AppBundle/Form/Type/CommentType.php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType,
    Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("company", 'text', [
                'label' => "comment.company.label",
                'attr'  => [
                    'placeholder' => "comment.company.placeholder"
                ]
            ])
            ->add("email", 'email', [
                'label' => "comment.email.label",
                'attr'  => [
                    'placeholder' => "comment.email.placeholder"
                ]
            ])
            ->add("comment", 'text', [
                'label' => "comment.comment.label",
                'attr'  => [
                    'placeholder' => "comment.comment.placeholder"
                ]
            ])
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class'         => 'AppBundle\Model\Comment',
            'translation_domain' => 'forms'
        ]);
    }

    public function getName()
    {
        return "comment_type";
    }
}