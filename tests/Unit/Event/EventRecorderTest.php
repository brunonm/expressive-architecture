<?php
declare(strict_types=1);

namespace ThatBook\Tests\Unit\Entity;

use ThatBook\Tests\Unit\AbstractUnitTestCase;
use ThatBook\Event\ReaderBookRegisteredEvent;
use ThatBook\Event\EventRecorder;
use ThatBook\Entity\Book;
use ThatBook\Entity\Reader;
use \Mockery as M;

class EventRecorderTest extends AbstractUnitTestCase
{
    public function testShouldReleaseEvents()
    {
        $event = new ReaderBookRegisteredEvent(M::mock(Book::class), M::mock(Reader::class));
        $recorder = new EventRecorder();
        $recorder->record($event);
        $this->assertCount(1, $recorder->releaseEvents());
    }

    public function testShouldEraseRecordedEvents()
    {
        $event = new ReaderBookRegisteredEvent(M::mock(Book::class), M::mock(Reader::class));
        $recorder = new EventRecorder();
        $recorder->record($event);
        $recorder->eraseEvents();
        $this->assertCount(0, $recorder->releaseEvents());
    }
}
