<?php
// src/AppBundle/Controller/XhrController.php
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpFoundation\Response,
    Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use AppBundle\Controller\Utility\Traits\FormErrorHandlerTrait,
    AppBundle\Model\Feedback,
    AppBundle\Form\Type\FeedbackType,
    AppBundle\Model\Comment,
    AppBundle\Form\Type\CommentType,
    AppBundle\Entity\Information,
    AppBundle\Entity\InformationCategory,
    AppBundle\Entity\Article;

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
     *      "/expats_information_load",
     *      name="expats_information_load",
     *      host="{_locale}.{domain}",
     *      defaults={"_locale" = "%locale%", "domain" = "%domain%"},
     *      requirements={"_locale" = "%locale%|en", "domain" = "%domain%"},
     *      condition="request.isXmlHttpRequest()"
     * )
     * @Route(
     *      "/expats_information_load",
     *      name="expats_information_load_default",
     *      host="{domain}",
     *      defaults={"_locale" = "%locale%", "domain" = "%domain%"},
     *      requirements={"domain" = "%domain%"},
     *      condition="request.isXmlHttpRequest()"
     * )
     */
    public function expatsInformationLoadAction(Request $request)
    {
        // I really wanted to see that badass loader! XD
        usleep(250000);

        // ---

        $_translator = $this->get('translator');

        if( !$request->request->has('location') || !is_array($request->request->get('location')) || empty($request->request->get('location')) )
            return new Response(json_encode([
                'message' => $_translator->trans('state.expats_information.empty.information')
            ]), 302);

        $categories = [];

        foreach( array_keys($request->request->get('location')) as $category )
        {
            if( in_array($category, InformationCategory::getInformationCategories(), TRUE) )
                $categories[] = $category;
        }

        if( !$categories )
            return new Response(json_encode([
                'message' => $_translator->trans('state.expats_information.empty.information')
            ]), 302);

        $_manager = $this->getDoctrine()->getManager();

        $information = $_manager->getRepository('AppBundle:Information')->findByCategories($categories);

        if( !$information ) {
            $response = [
                'data' => [
                    'message' => $_translator->trans('state.expats_information.empty.information')
                ],
                'code' => 500
            ];
        } else {
            $response = [
                'data' => [
                    'categories' => Information::getTransformedCategories($information, $_translator),
                    'locations'  => Information::getTransformedLocations($information)
                ],
                'code' => 200
            ];
        }
        
        return new Response(json_encode($response['data']), $response['code']);
    }

    /**
     * @Method({"POST"})
     * @Route(
     *      "/news_load",
     *      name="news_load",
     *      host="{_locale}.{domain}",
     *      defaults={"_locale" = "%locale%", "domain" = "%domain%"},
     *      requirements={"_locale" = "%locale%|en", "domain" = "%domain%"},
     *      condition="request.isXmlHttpRequest()"
     * )
     * @Route(
     *      "/news_load",
     *      name="news_load_default",
     *      host="{domain}",
     *      defaults={"_locale" = "%locale%", "domain" = "%domain%"},
     *      requirements={"domain" = "%domain%"},
     *      condition="request.isXmlHttpRequest()"
     * )
     */
    public function newsLoadAction(Request $request)
    {
        // I really wanted to see that badass loader! XD
        usleep(250000);

        // ---

        if( !$request->request->has('count') || !is_numeric($request->request->get('count')) || empty($request->request->get('count')) )
            return new Response(json_encode(['isLast' => TRUE]));

        $_manager = $this->getDoctrine()->getManager();

        $newsNumber = $_manager->getRepository('AppBundle:Article')->count();

        $news = $_manager->getRepository('AppBundle:Article')->findBy([], ['publicationDate' => 'DESC'], Article::ARTICLES_PER_LIFT, $request->request->get('count'));

        if( !$news ) {
            $response = [
                'data' => ['isLast' => TRUE],
                'code' => 200
            ];
        } else {
            $isLast = ( $request->request->get('count') + count($news) == $newsNumber );

            $response = [
                'data' => Article::getTransformedArticles($news, $isLast, $request->getLocale()),
                'code' => 200
            ];
        }

        return new Response(json_encode($response['data']), $response['code']);
    }
}
