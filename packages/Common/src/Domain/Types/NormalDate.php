<?php

declare(strict_types=1);

namespace Messagehub\Common\Domain\Types;

class NormalDate
{
    public function __construct(protected \DateTimeImmutable $value)
    {}

    public function value(): \DateTimeImmutable
    {
        return $this->value;
    }
}