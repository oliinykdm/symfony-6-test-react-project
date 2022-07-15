<?php

namespace Messagehub\ShortMessage\Application;

interface ShortMessageWriter
{
    public function add(ShortMessage $shortMessage): void;
}