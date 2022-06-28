<?php declare(strict_types=1);

namespace Messagehub\Common\Application\HandlerResponse\Error;

use Messagehub\Common\Application\HandlerResponse\ReturnResponse\ReturnResponse;
use Messagehub\ShortMessage\Application\CreateShortMessageValidator;
use Messagehub\Common\Application\HandlerResponse\HandlerResponse;
use Symfony\Component\HttpFoundation\Response;

abstract class Error extends ReturnResponse implements HandlerResponse
{
    public static function fromValidator(CreateShortMessageValidator $validator): Response
    {
        $messagesArray = [];
        if ($validator->hasValidationErrors()) {
            foreach ($validator->getValidationErrors() as $errorMessage) {
                $messagesArray[] = $errorMessage;
            }
        }
        return self::ajaxResponse(
            self::toJson(['status' => self::AJAX_STATUS_ERROR_CODE, 'data' => $messagesArray])
        );
    }
}