<?php
// src/AppBundle/Controller/FormController.php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use AppBundle\Model\Feedback,
    AppBundle\Form\Type\FeedbackType,
    AppBundle\Model\Comment,
    AppBundle\Form\Type\CommentType,
    AppBundle\Model\Proposal,
    AppBundle\Form\Type\ProposalType;

class FormController extends Controller
{
    public function feedbackAction(Request $request)
    {
        $feedbackForm = $this->createForm(new FeedbackType, new Feedback);

        return $this->render('AppBundle:Form:feedback.html.twig', [
            'locale' => $request->getLocale(),
            'form'   => $feedbackForm->createView()
        ]);
    }

    public function commentAction(Request $request)
    {
        $commentForm = $this->createForm(new CommentType, new Comment);

        return $this->render('AppBundle:Form:comment.html.twig', [
            'locale' => $request->getLocale(),
            'form'   => $commentForm->createView()
        ]);
    }
}
