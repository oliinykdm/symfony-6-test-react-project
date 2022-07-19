<?php declare(strict_types=1);

namespace Messagehub\Controller;

use Messagehub\ShortMessage\Application\Create\CreateShortMessage;
use Messagehub\ShortMessage\Application\Create\CreateShortMessageHandler;
use Messagehub\ShortMessage\Application\ShortMessageReader;
use Messagehub\ShortMessage\Application\ShortMessageValidator;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AddController extends AbstractController
{
    public function __construct(
        private CreateShortMessageHandler $createShortMessageHandler,
        private ShortMessageValidator $shortMessageValidator,
        private ShortMessageReader $shortMessageReader
    ) {}

    /**
     * @Route("/message/add", methods={"GET"})
     */
    public function index(): Response
    {
        return $this->render('shortmessages/adding/form.html.twig', [
                'shortMessages' => $this->shortMessageReader->findAll(),
                'latestInsertId' => null
            ]);
    }
    /**
     * @Route("/message/add", methods={"POST"})
     */
    public function add(Request $request): Response
    {
        $this->createShortMessageHandler->handle(
            new CreateShortMessage(
                $request->get('message_text'),
                1
            )
        );

        $response = new RedirectResponse('/message/add');
        if ($this->shortMessageValidator->hasErrors()) {
            foreach ($this->shortMessageValidator->getErrors() as $errorMessage) {
                $this->addFlash('errors', $errorMessage);
            }
            return $response;
        }

        $this->addFlash('success', 'Your short message was successfully submitted!');

        return $this->render('shortmessages/adding/form.html.twig', [
            'shortMessages' => $this->shortMessageReader->findAll(),
            'latestInsertId' => Uuid::fromString($this->createShortMessageHandler->getLatestInsertId()->toString())->getBytes()
        ]);

    }
}