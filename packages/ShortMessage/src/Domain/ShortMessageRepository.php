<?php

declare(strict_types=1);

namespace Messagehub\ShortMessage\Domain;

interface ShortMessageRepository
{
    public function save(ShortMessage $shortMessage): void;

    public function search(ShortMessageUuid $uuid): ?ShortMessage;
}
