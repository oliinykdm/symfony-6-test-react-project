<?php

declare(strict_types=1);

namespace Messagehub\Common\Domain\Types;

class NormalString
{
    public function __construct(protected string $value)
    {}

    public function value(): string
    {
        return $this->value;
    }
}