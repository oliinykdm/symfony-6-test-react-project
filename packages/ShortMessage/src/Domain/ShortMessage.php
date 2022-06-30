<?php declare(strict_types=1);

namespace Messagehub\ShortMessage\Domain;

final class ShortMessage
{
    public function __construct(
        private ShortMessageUuid $uuid,
        private ShortMessageText $text,
        private ShortMessageAuthor $author,
        private ShortMessageDate $date
    ) {
    }

    public static function generate(
        ShortMessageUuid $uuid,
        ShortMessageText $text,
        ShortMessageAuthor $author,
        ShortMessageDate $date
    ): ShortMessage
    {
        return new self($uuid, $text, $author, $date);
    }

    public function uuid(): ShortMessageUuid
    {
        return $this->uuid;
    }
    public function text(): ShortMessageText
    {
        return $this->text;
    }
    public function author(): ShortMessageAuthor
    {
        return $this->author;
    }
    public function date(): ShortMessageDate
    {
        return $this->date;
    }
}