<?php

declare(strict_types=1);

namespace Messagehub\ShortMessage\Infrastructure;

use Messagehub\ShortMessage\Domain\ShortMessage;
use Messagehub\ShortMessage\Domain\ShortMessageRepository;
use Messagehub\ShortMessage\Domain\ShortMessageUuid;

final class ShortMessageRepositoryMySql implements ShortMessageRepository
{
    public function save(ShortMessage $shortMessage): void
    {
        // DBAL STUFF
    }

    public function search(ShortMessageUuid $uuid): ?ShortMessage
    {
        // DBAL STUFF
    }
}
