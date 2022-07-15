<?php

namespace Messagehub\ShortMessage\Application;

use Messagehub\ShortMessage\Types\ShortMessageId;

interface ShortMessageReader
{
    public function findById(ShortMessageId $uuid): ?ShortMessage;
}