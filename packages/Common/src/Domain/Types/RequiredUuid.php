<?php

declare(strict_types=1);

namespace Messagehub\Common\Domain\Types;

use Ramsey\Uuid\Uuid as RamseyUuid;

class RequiredUuid
{
    public function __construct(string $value)
    {
        $value = strtolower($value);
        $this->value = $value;
    }

    public static function fromString(string $value): static
    {
        return new static($value);
    }

    public static function fromUuid(self $value): static
    {
        return new static($value->toString());
    }

    public static function generate(): self
    {
        return new static(RamseyUuid::uuid4()->toString());
    }

    public function value(): string
    {
        return $this->value;
    }

    public function toString(): string
    {
        return $this->value();
    }
    public function toBinary($value): string
    {

    }
}