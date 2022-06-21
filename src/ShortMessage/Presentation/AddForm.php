<?php declare(strict_types=1);

namespace App\ShortMessage\Presentation;

use App\Entity\ShortMessage;
use App\ShortMessage\Application\AddShortMessage;
use Symfony\Component\Uid\Uuid;

final class AddForm
{
    private string $message_text;
    private int $message_author;

    public function __construct(
        string $message_text,
        int $message_author
    ) {
        $this->message_text = $message_text;
        $this->message_author = $message_author;
    }

    public function getValidationErrors(): array
    {
        $errors = [];
        if(strlen($this->message_text) < 1 || strlen($this->message_text) > 200) {
            $errors[] = 'Message text must be between 1 and 200 characters';
        }
        if($this->message_author === 0) {
            $errors[] = 'Author should be set';
        }
        return $errors;
    }
    public function toCommand(): AddShortMessage
    {
        return new AddShortMessage(
            Uuid::v4(),
            $this->message_text,
            $this->message_author,
        );

    }
    public function hasValidationErrors(): bool
    {
        return (count($this->getValidationErrors()) > 0);
    }
}