<?php declare(strict_types=1);

namespace Messagehub\ShortMessage\Application;

use Symfony\Component\Uid\UuidV4;

final class CreateShortMessage
{
    private UuidV4 $uuid;
    private string $message_text;
    private int $message_author;

    public function __construct(UuidV4 $uuid, string $message_text, int $message_author)
    {
        $this->uuid = $uuid;
        $this->message_text = $message_text;
        $this->message_author = $message_author;
    }

    public function getUuid(): UuidV4
    {
        return $this->uuid;
    }

    public function getMessageText(): ?string
    {
        return $this->message_text;
    }

    public function getMessageAuthor(): ?int
    {
        return $this->message_author;
    }
}
