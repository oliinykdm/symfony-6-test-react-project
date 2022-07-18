<?php declare(strict_types=1);

namespace Messagehub\Common\Domain;

abstract class Validator
{
    protected array $errors = [];

    protected function addMessage($message): void
    {
        $this->errors[] = $message;
    }

    protected function getValidationErrors(): array
    {
        return $this->errors;
    }

    protected function hasValidationErrors(): bool
    {
        return (count($this->getValidationErrors()) > 0);
    }

    public function hasErrors(): bool
    {
        return $this->hasValidationErrors();
    }

    public function getErrors(): array
    {
        return $this->getValidationErrors();
    }
}