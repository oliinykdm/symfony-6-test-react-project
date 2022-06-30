<?php

declare(strict_types=1);

namespace Messagehub\Common\Domain\Types;
use Symfony\Component\Uid\Uuid as SymfonyUuid;

class Uuid implements \Stringable
{
    public function __construct(protected string $value)
    {}

    public static function generate(): self
    {
        return new static(SymfonyUuid::v4()->toRfc4122());
    }
    public function value(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value();
    }
}