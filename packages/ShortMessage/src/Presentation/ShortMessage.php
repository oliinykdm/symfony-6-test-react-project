<?php declare(strict_types=1);

namespace Messagehub\ShortMessage\Presentation;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Uid\UuidV4;

final class ShortMessage
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

    public static function generate(
        Request $request
    ): self {
        return new self(
            UuidV4::v4(),
            (string)$request->get('message_text'),
            1
        );
    }
}