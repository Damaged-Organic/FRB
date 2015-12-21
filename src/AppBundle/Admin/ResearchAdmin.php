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
            $pdfPreviewRequiredUA   = ( $research->getPdfPreviewNameUA() ) ? FALSE : TRUE;
            $pdfPreviewHelpOptionUA = ( $research->getPdfPreviewNameUA() ) ?: FALSE;

            $pdfPreviewHelpOptionEN = ( $research->getPdfPreviewNameEN() ) ?: FALSE;
        } else {
            $pdfPreviewRequiredUA   = TRUE;
            $pdfPreviewHelpOptionUA = FALSE;

            $pdfPreviewHelpOptionEN = FALSE;
        }

        $formMapper
            ->add("quarter", "choice", [
                "label"       => "Квартал",
                "choices"     => array_combine(range(1, 4), range(1, 4)),
                'constraints' => [
                    new Assert\Range(['min' => 0, 'max' => 4])
                ]
            ])
            ->add("year", "choice", [
                "label"       => "Рік",
                "choices"     => array_reverse(
                    array_combine(range(2000, (new DateTime)->format('Y')), range(2000, (new DateTime)->format('Y'))), TRUE
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
            ->add('pdfPreviewFileUA', 'vich_file', [
                'label'         => "PDF файл (UA)",
                'required'      => $pdfPreviewRequiredUA,
                'allow_delete'  => FALSE,
                'download_link' => TRUE,
                'help'          => $pdfPreviewHelpOptionUA
            ])
            ->add('pdfPreviewFileEN', 'vich_file', [
                'label'         => "PDF файл (EN)",
                'required'      => FALSE,
                'allow_delete'  => FALSE,
                'download_link' => TRUE,
                'help'          => $pdfPreviewHelpOptionEN
            ])
        ;
    }
}
