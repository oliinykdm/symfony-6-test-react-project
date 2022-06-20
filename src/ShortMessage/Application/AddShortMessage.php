<?php

namespace App\ShortMessage\Application;

use Symfony\Component\Uid\UuidV4;

final class AddShortMessage
{
    private $uuid;

    private $message_text;

    private $message_author;

    public function __construct(UuidV4 $uuid, string $message_text, int $message_author)
    {
        $this->uuid = $uuid;
        $this->message_text = $message_text;
        $this->message_author = $message_author;
    }

    public function getUuid()
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
