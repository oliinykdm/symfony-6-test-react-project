<?php declare(strict_types=1);

namespace Messagehub\Controller;

use Messagehub\ShortMessage\Presentation\ShortMessage;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;

class AddController extends AbstractController
{

    private object $shortMessage;
    public function __construct(
        ShortMessage $shortMessage
    ) {
        $this->shortMessage = $shortMessage;
    }
    /**
     * @Route("/message/add", methods={"GET"})
     */
    public function index(): Response
    {

        return $this->render('shortmessages/adding/form.html.twig', [
        ]);
    }
    /**
     * @Route("/message/add", methods={"POST"})
     */
    public function add(Request $request): Response
    {
        ShortMessage::generate($request);
        $response = new RedirectResponse('/message/add');


        $this->addFlash('success', 'Your short message was successfully submitted!');
        return $response;

    }
}