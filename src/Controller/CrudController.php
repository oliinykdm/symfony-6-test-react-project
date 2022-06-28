<?php declare(strict_types=1);

namespace Messagehub\Controller;

use Messagehub\ApiV1Bundle\Ajax\AjaxController;
use Messagehub\Entity\ShortMessageRepository;
use Messagehub\ShortMessage\Application\CreateShortMessageHandler;
use Messagehub\ShortMessage\Application\CreateShortMessageValidator;
use Messagehub\ShortMessage\Presentation\ShortMessage;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Uid\Uuid;

final class CrudController extends AjaxController
{

    private CreateShortMessageHandler $addingShortMessageHandler;
    public function __construct(

        CreateShortMessageHandler $addingShortMessageHandler,
    ) {

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
                $this->toJson(['status' => self::AJAX_STATUS_ERROR_CODE, 'data' => 'Probe hack! It seems that your CSRF token is invalid!'])
            );
        }
        $form = ShortMessage::generate($request);

        if ($form->hasValidationErrors()) {
            foreach ($form->getValidationErrors() as $errorMessage) {
                return $this->ajaxResponse(
                    $this->toJson(['status' => self::AJAX_STATUS_ERROR_CODE, 'data' => $errorMessage])
                );
            }
        }

        $this->addingShortMessageHandler->handle($form->toCommand());

        return $this->ajaxResponse(
            $this->toJson(['status' => self::AJAX_STATUS_SUCCESS_CODE])
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
    /**
     * @Route("/api/shortmessages", methods={"DELETE"})
     */
    public function deleteShortMessages(Request $request): Response
    {
        $uuid = Uuid::fromString($request->get('uuid'));

        $shortMessage = new ShortMessage();
        $shortMessage->setUuid($uuid->toBinary());

        $shortMessage = $this->shortMessageRepository->findOneByUuid($uuid->toBinary());

        if(!$shortMessage instanceof ShortMessage) {
            return $this->ajaxResponse(
                $this->toJson(['status' => self::AJAX_STATUS_ERROR_CODE])
            );
        }

        $this->shortMessageRepository->remove($shortMessage, true);

        return $this->ajaxResponse(
            $this->toJson(['status' => self::AJAX_STATUS_SUCCESS_CODE])
        );
    }
}