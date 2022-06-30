<?php declare(strict_types=1);

namespace Messagehub\ShortMessage\Application\Create;

use Messagehub\Common\Domain\Bus\Command\CommandHandler;
use Messagehub\ShortMessage\Domain\ShortMessageAuthor;
use Messagehub\ShortMessage\Domain\ShortMessageDate;
use Messagehub\ShortMessage\Domain\ShortMessageText;
use Messagehub\ShortMessage\Domain\ShortMessageUuid;

final class CreateShortMessageCommandHandler implements CommandHandler
{

    public function __construct(private ShortMessageCreator $creator)
    {
    }

    public function handle(CreateShortMessageCommand $command): void
    {
        $uuid = new ShortMessageUuid($command->uuid());
        $text = new ShortMessageText($command->text());
        $author = new ShortMessageAuthor($command->author());
        $date = new ShortMessageDate($command->date());

        $this->creator->create($uuid, $text, $author, $date);
    }
}