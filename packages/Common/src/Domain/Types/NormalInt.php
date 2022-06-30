<?php

declare(strict_types=1);

namespace Messagehub\Common\Domain\Types;

class NormalInt
{
    public function __construct(protected int $value)
    {}

    public function value(): int
    {
        return $this->value;
    }
}