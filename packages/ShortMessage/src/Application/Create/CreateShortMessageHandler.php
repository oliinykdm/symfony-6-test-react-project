<?php declare(strict_types=1);

namespace Messagehub\ShortMessage\Application\Create;

use Messagehub\ShortMessage\Application\ShortMessage;
use Messagehub\ShortMessage\Application\ShortMessageValidator;
use Messagehub\ShortMessage\Application\ShortMessageWriter;
use Messagehub\ShortMessage\Types\ShortMessageId;
use Ramsey\Uuid\Uuid;

final class CreateShortMessageHandler
{
    private ShortMessageId|null $messageId = null;

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
            $this->messageId = $shortMessageToSave->getId();
            $this->messageWriter->add($shortMessageToSave);
        }

        return true;
    }

    public function getLatestInsertId(): ShortMessageId {
        return $this->messageId;
    }
}