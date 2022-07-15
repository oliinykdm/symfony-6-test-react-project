<?php declare(strict_types=1);

namespace Messagehub\ShortMessage\Application\Create;

use Messagehub\ShortMessage\Types\ShortMessageAuthor;
use Messagehub\ShortMessage\Types\ShortMessageText;

final class CreateShortMessage
{
    private string $text;
    private int $author;
    private \DateTimeImmutable $date;

    public function __construct(
        string $text,
        int $author
    ) {
        $this->text = $text;
        $this->author = $author;
    }

    public function getText(): ShortMessageText
    {
        return ShortMessageText::fromString($this->text);
    }

    public function getAuthor(): ShortMessageAuthor
    {
        return ShortMessageAuthor::fromString($this->author);
    }
}
