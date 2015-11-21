<?php
// src/AppBundle/Controller/FormController.php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpFoundation\Response,
    Symfony\Component\HttpFoundation\JsonResponse;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use AppBundle\Controller\Utility\Traits\FormErrorHandlerTrait;

use AppBundle\Model\Feedback,
    AppBundle\Form\Type\FeedbackType,
    AppBundle\Model\Proposal,
    AppBundle\Form\Type\ProposalType;

class FormController extends Controller
{
    use FormErrorHandlerTrait;

    public function feedbackAction($_locale)
    {
        $feedbackForm = $this->createForm(new FeedbackType, new Feedback);

        return $this->render('AppBundle:Form:feedback.html.twig', [
            '_locale'      => $_locale,
            'feedbackForm' => $feedbackForm->createView()
        ]);
    }

    public function proposalAction($_locale)
    {
        $proposalForm = $this->createForm(new ProposalType($this->getDoctrine()->getManager()), new Proposal);

        return $this->render('AppBundle:Form:proposal.html.twig', [
            '_locale'      => $_locale,
            'proposalForm' => $proposalForm->createView()
        ]);
    }
}