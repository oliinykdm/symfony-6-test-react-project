<?php declare(strict_types=1);

namespace Messagehub\ShortMessage\Application;

use Messagehub\Common\Domain\Validator;
use Messagehub\ShortMessage\Application\Create\CreateShortMessage;

final class ShortMessageValidator extends Validator
{
    public function validateCreate(CreateShortMessage $command): void
    {
        $this->validateTextNotEmpty($command->getText()->value());
        $this->validateAuthorNotEmpty($command->getAuthor()->value());
    }

    public function validateTextNotEmpty($text): bool
    {
        if(strlen($text) < 1 || strlen($text) > 200) {
            $this->addMessage('Message text must be between 1 and 200 characters');
            return false;
        }
        else {
            return true;
        }
    }

    public function validateAuthorNotEmpty($author): bool
    {
        if(empty($author)) {
            $this->addMessage('Author must be not empty');
            return false;
        }
        else {
            return true;
        }
    }
}