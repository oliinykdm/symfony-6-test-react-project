<?php declare(strict_types=1);

namespace Messagehub\Common\Application\HandlerResponse\Success;

use Messagehub\Common\Application\HandlerResponse\ReturnResponse\ReturnResponse;
use Messagehub\Common\Application\HandlerResponse\HandlerResponse;

abstract class Success extends ReturnResponse implements HandlerResponse
{
    protected array $messages = [];

    public function __construct(array $messages)
    {
        $this->messages = $messages;
    }

    public static function returnResponse($data)
    {
        return self::ajaxResponse(
            self::toJson(['status' => self::AJAX_STATUS_SUCCESS_CODE, 'data' => $data])
        );
    }
}