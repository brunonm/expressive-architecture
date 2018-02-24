<?php
declare(strict_types=1);

namespace ThatBook\Middleware;

use League\Tactician\Middleware;

class GraphQLMiddleware implements Middleware
{
    /**
     * @param object $command
     * @param callable $next
     * @return mixed
     * @throws \Exception | \Throwable
     */
    public function execute($command, callable $next)
    {
        try {
            $returnValue = $next($command);
            if (null === $returnValue) {
                $returnValue = true;
            }
        } catch (\Exception | \Throwable $exception) {
            throw $exception;
        }

        return $returnValue;
    }
}
