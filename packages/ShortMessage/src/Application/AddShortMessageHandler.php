<?php declare(strict_types=1);

namespace Messagehub\ShortMessage\Application;

use Messagehub\Entity\ShortMessage;
use Messagehub\Entity\ShortMessageRepository;

final class AddShortMessageHandler
{
    private ShortMessageRepository $shortMessageRepository;
    public function __construct(ShortMessageRepository $shortMessageRepository)
    {
        $this->shortMessageRepository = $shortMessageRepository;
    }
    public function handle(AddShortMessage $command): void
    {
        $shortMessage = new ShortMessage();
        $shortMessage
            ->setUuid($command->getUuid())
            ->setMessageText($command->getMessageText())
            ->setMessageAuthor($command->getMessageAuthor())
            ->setMessageDate(new \DateTimeImmutable());

        $this->shortMessageRepository->add($shortMessage, true);
    }
}