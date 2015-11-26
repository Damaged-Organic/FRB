<?php
// src/AppBundle/Controller/XhrController.php
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpFoundation\Response,
    Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use AppBundle\Controller\Utility\Traits\FormErrorHandlerTrait;

use AppBundle\Model\Feedback,
    AppBundle\Form\Type\FeedbackType,
    AppBundle\Model\Comment,
    AppBundle\Form\Type\CommentType,
    AppBundle\Model\Proposal,
    AppBundle\Form\Type\ProposalType;

class XhrController extends Controller
{
    use FormErrorHandlerTrait;

    /**
     * @Method({"POST"})
     * @Route(
     *      "/comment_send",
     *      name="comment_send",
     *      host="{_locale}.{domain}",
     *      defaults={"_locale" = "%locale%", "domain" = "%domain%"},
     *      requirements={"_locale" = "%locale%|en", "domain" = "%domain%"},
     *      condition="request.isXmlHttpRequest()"
     * )
     * @Route(
     *      "/comment_send",
     *      name="comment_send_default",
     *      host="{domain}",
     *      defaults={"_locale" = "%locale%", "domain" = "%domain%"},
     *      requirements={"domain" = "%domain%"},
     *      condition="request.isXmlHttpRequest()"
     * )
     */
    public function commentSendAction(Request $request)
    {
        $commentForm = $this->createForm(new CommentType, ($comment = new Comment));

        $commentForm->handleRequest($request);

        if( !($commentForm->isValid()) ) {
            $response = [
                'data' => $this->stringifyFormErrors($commentForm),
                'code' => 500
            ];
        } else {
            $_translator     = $this->get('translator');
            $_mailerShortcut = $this->get('app.mailer_shortcut');

            $from = [$this->container->getParameter('email')['no-reply'] => 'FRBrokerage.Net'];

            $to = $this->container->getParameter('email')['comment'];

            $subject = $_translator->trans("comment.subject", [], 'emails');

            $body = $this->renderView('AppBundle:Email:comment.html.twig', [
                'comment'  => $comment
            ]);

            if( !$_mailerShortcut->sendMail($from, $to, $subject, $body) ) {
                $response = [
                    'data' => $_translator->trans("comment.fail", [], 'responses'),
                    'code' => 500
                ];
            } else {
                $response = [
                    'data' => json_encode(['message' => $_translator->trans("comment.success", [], 'responses')]),
                    'code' => 200
                ];
            }
        }

        return new Response($response['data'], $response['code']);
    }

    /**
     * @Method({"POST"})
     * @Route(
     *      "/feedback_send",
     *      name="feedback_send",
     *      host="{_locale}.{domain}",
     *      defaults={"_locale" = "%locale%", "domain" = "%domain%"},
     *      requirements={"_locale" = "%locale%|en", "domain" = "%domain%"},
     *      condition="request.isXmlHttpRequest()"
     * )
     * @Route(
     *      "/feedback_send",
     *      name="feedback_send_default",
     *      host="{domain}",
     *      defaults={"_locale" = "%locale%", "domain" = "%domain%"},
     *      requirements={"domain" = "%domain%"},
     *      condition="request.isXmlHttpRequest()"
     * )
     */
    public function feedbackSendAction(Request $request)
    {
        $feedbackForm = $this->createForm(new FeedbackType, ($feedback = new Feedback));

        $feedbackForm->handleRequest($request);

        if( !($feedbackForm->isValid()) ) {
            $response = [
                'data' => $this->stringifyFormErrors($feedbackForm),
                'code' => 500
            ];
        } else {
            $_translator     = $this->get('translator');
            $_mailerShortcut = $this->get('app.mailer_shortcut');

            $from = [$this->container->getParameter('email')['no-reply'] => 'FRBrokerage.Net'];

            $to = $this->container->getParameter('email')['feedback'];

            $subject = $_translator->trans("feedback.subject", [], 'emails');

            $body = $this->renderView('AppBundle:Email:feedback.html.twig', [
                'feedback'  => $feedback
            ]);

            if( !$_mailerShortcut->sendMail($from, $to, $subject, $body) ) {
                $response = [
                    'data' => $_translator->trans("feedback.fail", [], 'responses'),
                    'code' => 500
                ];
            } else {
                $response = [
                    'data' => json_encode(['message' => $_translator->trans("feedback.success", [], 'responses')]),
                    'code' => 200
                ];
            }
        }

        return new Response($response['data'], $response['code']);
    }

    /**
     * @Method({"POST"})
     * @Route(
     *      "/proposal_send",
     *      name="proposal_send",
     *      host="{_locale}.{domain}",
     *      defaults={"_locale" = "%locale%", "domain" = "%domain%"},
     *      requirements={"_locale" = "%locale%|en", "domain" = "%domain%"},
     *      condition="request.isXmlHttpRequest()"
     * )
     * @Route(
     *      "/proposal_send",
     *      name="proposal_send_default",
     *      host="{domain}",
     *      defaults={"_locale" = "%locale%", "domain" = "%domain%"},
     *      requirements={"domain" = "%domain%"},
     *      condition="request.isXmlHttpRequest()"
     * )
     */
    public function proposalSendAction(Request $request)
    {
        $_manager = $this->getDoctrine()->getManager();

        $proposalForm = $this->createForm(new ProposalType($_manager), ($proposal = new Proposal));

        $proposalForm->handleRequest($request);

        if( !($proposalForm->isValid()) ) {
            $response = [
                'data' => $this->stringifyFormErrors($proposalForm),
                'code' => 500
            ];
        } else {
            $_translator     = $this->get('translator');
            $_mailerShortcut = $this->get('app.mailer_shortcut');

            $from = [$this->container->getParameter('email')['no-reply'] => 'FRBrokerage.Net'];

            $to = $this->container->getParameter('email')['proposal'];

            $subject = $_translator->trans("proposal.subject", [], 'emails');

            $body = $this->renderView('AppBundle:Email:proposal.html.twig', [
                'proposal'  => $proposal
            ]);

            if( !$_mailerShortcut->sendMail($from, $to, $subject, $body) ) {
                $response = [
                    'data' => $_translator->trans("proposal.fail", [], 'responses'),
                    'code' => 500
                ];
            } else {
                $response = [
                    'data' => json_encode(['message' => $_translator->trans("proposal.success", [], 'responses')]),
                    'code' => 200
                ];
            }
        }

        return new Response($response['data'], $response['code']);
    }
}