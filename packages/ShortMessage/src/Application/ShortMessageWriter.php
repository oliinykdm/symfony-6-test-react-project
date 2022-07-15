<?php declare(strict_types=1);

namespace Messagehub\ShortMessage\Application;

interface ShortMessageWriter
{
    public function add(ShortMessage $shortMessage): void;
}