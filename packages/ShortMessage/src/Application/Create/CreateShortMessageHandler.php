<?php declare(strict_types=1);

namespace Messagehub\ShortMessage\Application\Create;

use Messagehub\ShortMessage\Application\ShortMessage;
use Messagehub\ShortMessage\Application\ShortMessageWriter;

final class CreateShortMessageHandler
{
    public function __construct(
        private ShortMessageWriter $messageWriter
        // validator
    ) {}

    public function handle(CreateShortMessage $command): bool
    {
        $shortMessageToSave = ShortMessage::generate(
            $command->getText(),
            $command->getAuthor()
        );

        $this->messageWriter->add($shortMessageToSave);

        return true;
    }
}