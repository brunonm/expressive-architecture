<?php
declare(strict_types=1);

namespace ThatBook\Tests\Unit\Service\Reader;

use ThatBook\Tests\Unit\AbstractUnitTestCase;
use ThatBook\Entity\Reader;
use ThatBook\Entity\Book;
use ThatBook\Service\RegisterReaderWish;
use ThatBook\Service\RegisterReaderWishHandler;
use ThatBook\Repository\ReaderRepository;
use ThatBook\Repository\BookRepository;
use \Mockery as M;

class RegisterReaderWishHandlerTest extends AbstractUnitTestCase
{
    private $handler;

    private $readerRepoMock;

    private $bookRepoMock;

    protected function setUp()
    {
        $this->readerRepoMock = M::mock(ReaderRepository::class);
        $this->bookRepoMock = M::mock(BookRepository::class);
        $this->handler = new RegisterReaderWishHandler($this->readerRepoMock, $this->bookRepoMock);
    }

    public function testShouldRegisterAWish()
    {
        $readerMock = M::mock(Reader::class);
        $readerMock->shouldReceive('registerWish')->once();

        $this->readerRepoMock
            ->shouldReceive('find')
            ->andReturn($readerMock);

        $this->readerRepoMock
            ->shouldReceive('store')
            ->once();

        $this->bookRepoMock
            ->shouldReceive('find')
            ->andReturn(M::mock(Book::class));

        $command = new RegisterReaderWish('bookId', 'readerId');

        $this->handler->handle($command);
    }

    /**
     * @expectedException ThatBook\Exception\BookNotFoundException
     */
    public function testShouldThrowExceptionIfBookNotFound()
    {
        $this->readerRepoMock->shouldReceive('find')->andReturn(M::mock(Reader::class));
        $this->bookRepoMock->shouldReceive('find')->andReturn(null);
        $command = new RegisterReaderWish('bookId', 'readerId');
        $this->handler->handle($command);
    }

    /**
     * @expectedException ThatBook\Exception\ReaderNotFoundException
     */
    public function testShouldThrowExceptionIfReaderNotFound()
    {
        $this->readerRepoMock->shouldReceive('find')->andReturn(null);
        $this->bookRepoMock->shouldReceive('find')->andReturn(M::mock(Book::class));
        $command = new RegisterReaderWish('bookId', 'readerId');
        $this->handler->handle($command);
    }
}
