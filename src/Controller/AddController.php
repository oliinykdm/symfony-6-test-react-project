<?php declare(strict_types=1);

namespace Messagehub\Controller;


use Messagehub\Common\Domain\Bus\Command\CommandBus;
use Messagehub\Common\Domain\Types\Uuid;
use Messagehub\ShortMessage\Application\Create\CreateShortMessageCommand;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use DateTimeImmutable;

class AddController extends AbstractController
{
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
            new CreateShortMessageCommand(
                Uuid::generate()->value(),
                'test',
                1,
                new \DateTimeImmutable()
            );


        $response = new RedirectResponse('/message/add');


       // $form = $this->addingFormFactory->createFromRequest($request);

//        if ($form->hasValidationErrors()) {
//            foreach ($form->getValidationErrors() as $errorMessage) {
//                $this->addFlash('errors', $errorMessage);
//            }
//            return $response;
//        }
       // $this->addingShortMessageHandler->handle($form->toCommand());
//        $this->addFlash('success', 'Your short message was successfully submitted!');
//        return $response;
        return $this->render('shortmessages/adding/form.html.twig', [
        ]);

    }
}