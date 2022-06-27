<?php declare(strict_types=1);

namespace Messagehub\Controller;

use Messagehub\ShortMessage\Application\CreateShortMessageHandler;
use Messagehub\ShortMessage\Presentation\AddFormFactory;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;

class AddController extends AbstractController
{
    private object $addingFormFactory;
    private object $addingShortMessageHandler;
    public function __construct(
        AddFormFactory            $addingFormFactory,
        CreateShortMessageHandler $addingShortMessageHandler,
    ) {
        $this->addingFormFactory = $addingFormFactory;
        $this->addingShortMessageHandler = $addingShortMessageHandler;
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
        $response = new RedirectResponse('/message/add');
        $form = $this->addingFormFactory->createFromRequest($request);

        if ($form->hasValidationErrors()) {
            foreach ($form->getValidationErrors() as $errorMessage) {
                $this->addFlash('errors', $errorMessage);
            }
            return $response;
        }
        $this->addingShortMessageHandler->handle($form->toCommand());
        $this->addFlash('success', 'Your short message was successfully submitted!');
        return $response;

    }
}