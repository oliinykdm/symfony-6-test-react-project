<?php declare(strict_types=1);

namespace Messagehub\ShortMessage\Application;

use Messagehub\Entity\ShortMessage;
use Messagehub\Entity\ShortMessageRepository;

final class CreateShortMessageHandler
{
    private ShortMessageRepository $shortMessageRepository;

    public function __construct(ShortMessageRepository $shortMessageRepository)
    {
        $this->shortMessageRepository = $shortMessageRepository;
    }

    public function handle(CreateShortMessage $command): void
    {
        $shortMessage = new ShortMessage();
        $shortMessage
            ->setUuid($command->getUuid())
            ->setMessageText($command->getMessageText())
            ->setMessageAuthor($command->getMessageAuthor())
            ->setMessageDate(new \DateTimeImmutable());

        // TODO Replace ORM Entity with Dbal Writer
        $this->shortMessageRepository->add($shortMessage, true);
    }
}