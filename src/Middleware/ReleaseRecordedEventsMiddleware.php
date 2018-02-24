<?php
declare(strict_types=1);

namespace ThatBook\Middleware;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use League\Tactician\Middleware;
use ThatBook\Event\EventRecorder;

class ReleaseRecordedEventsMiddleware implements Middleware
{
    /**
     * @var EventRecorder
     */
    private $eventRecorder;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @param EventRecorder $eventRecorder
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(EventRecorder $eventRecorder, EventDispatcherInterface $eventDispatcher)
    {
        $this->eventRecorder = $eventRecorder;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @inheritdoc
     */
    public function execute($command, callable $next)
    {
        try {
            $result = $next($command);
        } catch (\Exception $exception) {
            $this->eventRecorder->eraseEvents();
            throw $exception;
        }

        $recordedEvents = $this->eventRecorder->releaseEvents();

        foreach ($recordedEvents as $event) {
            $this->eventDispatcher->dispatch($event->getName(), $event);
        }

        return $result;
    }
}
