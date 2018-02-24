<?php
declare(strict_types=1);

namespace ThatBook\Queue;

abstract class AbstractQueueableCommand
{
    public function toMessage(): string
    {
        return serialize($this);
    }
}
