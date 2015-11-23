<?php
// src/AppBundle/Admin/ResearchAdmin.php
namespace AppBundle\Admin;

use DateTime;

use Symfony\Component\Validator\Constraints as Assert;

use Sonata\AdminBundle\Admin\Admin,
    Sonata\AdminBundle\Datagrid\ListMapper,
    Sonata\AdminBundle\Datagrid\DatagridMapper,
    Sonata\AdminBundle\Form\FormMapper;

use AppBundle\Entity\Repository\ResearchCategoryRepository;

class ResearchAdmin extends Admin
{
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add("id", "number", [
                "label" => "ID"
            ])
            ->addIdentifier("quarter", "number", [
                "label" => "Квартал"
            ])
            ->add("year", "number", [
                "label" => "Рік"
            ])
            ->add("researchCategory", "text", [
                "label" => "Категорія"
            ])
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        if( $research = $this->getSubject() ){
            $pdfPreviewRequired   = ( $research->getPdfPreviewName() ) ? FALSE : TRUE;
            $pdfPreviewHelpOption = ( $research->getPdfPreviewName() ) ?: FALSE;
        } else {
            $pdfPreviewRequired   = TRUE;
            $pdfPreviewHelpOption = FALSE;
        }

        $formMapper
            ->add("quarter", "choice", [
                "label"       => "Квартал",
                "choices"     => range(1, 4),
                'constraints' => [
                    new Assert\Range(['min' => 0, 'max' => 4])
                ]
            ])
            ->add("year", "choice", [
                "label"       => "Рік",
                "choices"     => array_reverse(
                    range(2000, (new DateTime)->format('Y'))
                ),
                "constraints" => [
                    new Assert\Range(['min' => 0])
                ]
            ])
            ->add('researchCategory','entity', [
                    'class'         => 'AppBundle:ResearchCategory',
                    'query_builder' => function(ResearchCategoryRepository $repository) { return $repository->createQueryBuilder('c')->orderBy('c.id', 'ASC'); },
                    'property'      => 'title',
                    'label'         => 'Категорія',
                    'empty_value'   => 'Оберіть категорію...'
            ])
            ->add('pdfPreviewFile', 'vich_file', [
                'label'         => "PDF файл",
                'required'      => $pdfPreviewRequired,
                'allow_delete'  => FALSE,
                'download_link' => TRUE,
                'help'          => $pdfPreviewHelpOption
            ])
        ;
    }
}