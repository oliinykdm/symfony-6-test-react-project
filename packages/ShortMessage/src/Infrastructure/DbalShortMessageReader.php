<?php

namespace Messagehub\ShortMessage\Infrastructure;

use Doctrine\DBAL\Connection;
use Messagehub\ShortMessage\Application\ShortMessage;
use Messagehub\ShortMessage\Types\ShortMessageId;

class DbalShortMessageReader
{
    public function __construct(
        private Connection $connection
    ) {}

    public function findById(ShortMessageId $uuid): ?ShortMessage
    {
        // DBAL STUFF
    }
}