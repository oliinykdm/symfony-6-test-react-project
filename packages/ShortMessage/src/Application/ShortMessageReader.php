<?php declare(strict_types=1);

namespace Messagehub\ShortMessage\Application;

use Messagehub\ShortMessage\Types\ShortMessageId;

interface ShortMessageReader
{
    public function findById(ShortMessageId $uuid): ?ShortMessage;
    public function findAll(): ?array;
}