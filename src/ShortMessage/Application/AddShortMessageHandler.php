<?php declare(strict_types=1);

namespace App\ShortMessage\Application;

use App\Entity\ShortMessage;
use App\Entity\ShortMessageRepository;

final class AddShortMessageHandler
{
    private object $shortMessageRepository;
    public function __construct(ShortMessageRepository $shortMessageRepository)
    {
        $this->shortMessageRepository = $shortMessageRepository;
    }
    public function handle(AddShortMessage $command):void
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