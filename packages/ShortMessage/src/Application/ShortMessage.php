<?php declare(strict_types=1);

namespace Messagehub\ShortMessage\Application;

use Messagehub\Common\Domain\Types\RequiredUuid;
use Messagehub\ShortMessage\Types\ShortMessageAuthor;
use Messagehub\ShortMessage\Types\ShortMessageDate;
use Messagehub\ShortMessage\Types\ShortMessageText;
use Messagehub\ShortMessage\Types\ShortMessageId;

final class ShortMessage
{
    public function __construct(
        private ShortMessageId           $uuid,
        private ShortMessageText         $text,
        private ShortMessageAuthor       $author,
        private ShortMessageDate         $date
    ) {
    }

    public static function generate(
        ShortMessageText         $text,
        ShortMessageAuthor       $author,
    ): ShortMessage {
        return new self(
            ShortMessageId::fromString(RequiredUuid::generate()->toString()),
            $text,
            $author,
            ShortMessageDate::now()
        );
    }

    public function setText(
        ShortMessageText $text,
    ): self {
        return new self(
            $this->uuid,
            $text,
            $this->author,
            $this->date
        );
    }

    public function getId(): ShortMessageId
    {
        return $this->uuid;
    }
    public function getText(): ShortMessageText
    {
        return $this->text;
    }
    public function getAuthor(): ShortMessageAuthor
    {
        return $this->author;
    }
    public function getDate(): ShortMessageDate
    {
        return $this->date;
    }
}