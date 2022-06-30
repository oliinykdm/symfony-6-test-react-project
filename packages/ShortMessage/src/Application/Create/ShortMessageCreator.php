<?php declare(strict_types=1);

namespace Messagehub\ShortMessage\Application\Create;

use Messagehub\ShortMessage\Domain\ShortMessageAuthor;
use Messagehub\ShortMessage\Domain\ShortMessageDate;
use Messagehub\ShortMessage\Domain\ShortMessageRepository;
use Messagehub\ShortMessage\Domain\ShortMessageText;
use Messagehub\ShortMessage\Domain\ShortMessageUuid;
use Messagehub\ShortMessage\Domain\ShortMessage;

final class ShortMessageCreator {
    public function __construct(private ShortMessageRepository $repository)
    {
    }

    public function create(ShortMessageUuid $uuid, ShortMessageText $text, ShortMessageAuthor $author, ShortMessageDate $date): void
    {
        $this->repository->save(ShortMessage::generate($uuid, $text, $author, $date));
    }
}