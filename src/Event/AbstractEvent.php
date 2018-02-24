<?php
declare(strict_types=1);

namespace ThatBook\Event;

use Symfony\Component\EventDispatcher\Event;

abstract class AbstractEvent extends Event
{
    public abstract static function getName(): string;
}
