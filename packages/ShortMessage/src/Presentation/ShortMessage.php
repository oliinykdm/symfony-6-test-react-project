<?php declare(strict_types=1);

namespace Messagehub\ShortMessage\Presentation;


use Messagehub\ShortMessage\Application\Create\CreateShortMessageCommand;
use Messagehub\ShortMessage\Application\Create\CreateShortMessageCommandHandler;
use Symfony\Component\HttpFoundation\Request;

final class ShortMessage
{
    public function __construct(

    )
    {}
    public function createFromRequest(Request $request): void {
        echo $request->get('message_text');
    }
}