<?php
declare(strict_types=1);

namespace ThatBook\Middleware;

use ThatBook\Queue\AbstractQueueableCommand;
use League\Tactician\Middleware;

class QueueMiddleware implements Middleware
{
    /**
     * @param mixed $command
     * @param callable $next
     * @return mixed
     * @throws \Exception | \Throwable
     */
    public function execute($command, callable $next)
    {
        try {

            if (!$command instanceof AbstractQueueableCommand) {
                return $next($command);
            }

//            $this->producer->publish(
//                $command->publisherServiceName(),
//                $command->toMessage(),
//                $command->routingKey()
//            );

        } catch (\Exception | \Throwable $exception) {
            throw $exception;
        }
    }
}
