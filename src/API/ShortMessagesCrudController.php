<?php declare(strict_types=1);

namespace App\API;

use App\API\Ajax\AjaxController;
use App\Entity\ShortMessageRepository;
use App\ShortMessage\Application\AddShortMessageHandler;
use App\ShortMessage\Presentation\AddFormFactory;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

final class ShortMessagesCrudController extends AjaxController
{
    private object $shortMessageRepository;
    private object $addingFormFactory;
    private object $addingShortMessageHandler;
    public function __construct(
        ShortMessageRepository $shortMessageRepository,
        AddFormFactory         $addingFormFactory,
        AddShortMessageHandler $addingShortMessageHandler,
    )
    {
        $this->shortMessageRepository = $shortMessageRepository;
        $this->addingFormFactory = $addingFormFactory;
        $this->addingShortMessageHandler = $addingShortMessageHandler;
    }
    /**
     * @Route("/api/shortmessages", methods={"POST"})
     */
    public function addNewShortMessage(Request $request): Response
    {
        $token_id = $request->headers->get('X-CSRF-ID');
        $token_value = $request->headers->get('X-CSRF-TOKEN');

        if(!$this->isCsrfTokenValid($token_id, $token_value)) {
            return $this->ajaxResponse(
                $this->toJson(['status' => 'error', 'data' => 'Probe hack! It seems that your CSRF token is invalid!'])
            );
        }
        $form = $this->addingFormFactory->createFromRequest($request);

        if ($form->hasValidationErrors()) {
            foreach ($form->getValidationErrors() as $errorMessage) {
                return $this->ajaxResponse(
                    $this->toJson(['status' => 'error', 'data' => $errorMessage])
                );
            }
        }

        $this->addingShortMessageHandler->handle($form->toCommand());

        return $this->ajaxResponse(
            $this->toJson(['status' => 'success'])
        );
    }
    /**
     * @Route("/api/shortmessages", methods={"GET"})
     */
    public function getAllShortMessages(): Response
    {
        $messages = $this->shortMessageRepository->createQueryBuilder('s')
            ->orderBy('s.message_date', 'DESC')
            ->getQuery()
            ->execute();
        return $this->ajaxResponse(
            $this->toJson($messages)
        );
    }
}