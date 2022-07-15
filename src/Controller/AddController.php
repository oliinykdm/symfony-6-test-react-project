<?php declare(strict_types=1);

namespace Messagehub\Controller;

use Messagehub\Common\Domain\Types\RequiredUuid;
use Messagehub\ShortMessage\Application\Create\CreateShortMessage;
use Messagehub\ShortMessage\Application\Create\CreateShortMessageHandler;
use Messagehub\ShortMessage\Application\ShortMessage;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AddController extends AbstractController
{
    public function __construct(
        private CreateShortMessageHandler $createShortMessageHandler
    ) {}

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
        $response = $this->createShortMessageHandler->handle(
            new CreateShortMessage(
                $request->get('message_text'),
                1
            )
        );

        $response = new RedirectResponse('/message/add');

        return $this->render('shortmessages/adding/form.html.twig', [
        ]);

    }
}