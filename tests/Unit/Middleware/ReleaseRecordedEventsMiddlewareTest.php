<?php
declare(strict_types=1);

namespace ThatBook\Tests\Unit\Entity;

use ThatBook\Tests\Unit\AbstractUnitTestCase;
use ThatBook\Event\EventRecorder;
use ThatBook\Middleware\ReleaseRecordedEventsMiddleware;
use ThatBook\Event\ReaderBookRegisteredEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use \Mockery as M;

class ReleaseRecordedEventsTest extends AbstractUnitTestCase
{
    public function testShouldReleaseEvents()
    {
        $eventMock = M::mock(ReaderBookRegisteredEvent::class)->makePartial();

        $recorderMock = M::mock(EventRecorder::class);
        $recorderMock->shouldReceive('releaseEvents')->andReturn([$eventMock]);

        $dispatcherMock = M::mock(EventDispatcherInterface::class);
        $dispatcherMock->shouldReceive('dispatch')->once();

        $middleware = new ReleaseRecordedEventsMiddleware($recorderMock, $dispatcherMock);

        $middleware->execute('command', function () {});
    }
}
