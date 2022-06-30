<?php declare(strict_types=1);

namespace Messagehub\ShortMessage\Application\Create;

use Messagehub\Common\Domain\Bus\Command\Command;


final class CreateShortMessageCommand implements Command
{
    private string $uuid;
    private string $text;
    private int $author;
    private \DateTimeImmutable $date;

    public function __construct(
        string $uuid,
        string $text,
        int $author,
        \DateTimeImmutable $date
    )
    {
        $this->uuid = $uuid;
        $this->text = $text;
        $this->author = $author;
        $this->date = $date;
    }

    public function uuid(): string
    {
        return $this->uuid;
    }
    public function text(): string
    {
        return $this->text;
    }
    public function author(): int
    {
        return $this->author;
    }
    public function date(): \DateTimeImmutable
    {
        return $this->date;
    }
}
