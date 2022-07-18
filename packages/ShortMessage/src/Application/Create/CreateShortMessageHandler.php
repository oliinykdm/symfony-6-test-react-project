<?php declare(strict_types=1);

namespace Messagehub\ShortMessage\Application\Create;

use Messagehub\ShortMessage\Application\ShortMessage;
use Messagehub\ShortMessage\Application\ShortMessageValidator;
use Messagehub\ShortMessage\Application\ShortMessageWriter;

final class CreateShortMessageHandler
{
    public function __construct(
        private ShortMessageWriter $messageWriter,
        private ShortMessageValidator $shortMessageValidator
    ) {}

    public function handle(CreateShortMessage $command): bool
    {
        $shortMessageToSave = ShortMessage::generate(
            $command->getText(),
            $command->getAuthor()
        );

        $this->shortMessageValidator->validateCreate($command);

        if($this->shortMessageValidator->getErrors()) {
            return false;
        }
        else {
            $this->messageWriter->add($shortMessageToSave);
        }

        return true;
    }
}