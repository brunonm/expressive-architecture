<?php
declare(strict_types=1);

namespace ThatBook\Tests\Unit\Service\Reader;

use ThatBook\Tests\Unit\AbstractUnitTestCase;
use ThatBook\Entity\Reader;
use ThatBook\Entity\Book;
use ThatBook\Service\Reader\RegisterReaderBook;
use ThatBook\Service\Reader\RegisterReaderBookHandler;
use ThatBook\Repository\ReaderRepository;
use ThatBook\Repository\BookRepository;
use \Mockery as M;

class RegisterReaderBookHandlerTest extends AbstractUnitTestCase
{
    private $handler;

    private $readerRepoMock;

    private $bookRepoMock;

    protected function setUp()
    {
        $this->readerRepoMock = M::mock(ReaderRepository::class);
        $this->bookRepoMock = M::mock(BookRepository::class);
        $this->handler = new RegisterReaderBookHandler($this->readerRepoMock, $this->bookRepoMock);
    }

    public function testShouldRegisterABook()
    {
        $readerMock = M::mock(Reader::class);
        $readerMock->shouldReceive('registerBook')->once();

        $this->readerRepoMock
            ->shouldReceive('find')
            ->andReturn($readerMock);

        $this->readerRepoMock
            ->shouldReceive('store')
            ->once();

        $this->bookRepoMock
            ->shouldReceive('find')
            ->andReturn(M::mock(Book::class));

        $command = new RegisterReaderBook('bookId', 'readerId');

        $this->handler->handle($command);
    }

    /**
     * @expectedException ThatBook\Exception\BookNotFoundException
     */
    public function testShouldThrowExceptionIfBookNotFound()
    {
        $this->readerRepoMock->shouldReceive('find')->andReturn(M::mock(Reader::class));
        $this->bookRepoMock->shouldReceive('find')->andReturn(null);
        $command = new RegisterReaderBook('bookId', 'readerId');
        $this->handler->handle($command);
    }

    /**
     * @expectedException ThatBook\Exception\ReaderNotFoundException
     */
    public function testShouldThrowExceptionIfReaderNotFound()
    {
        $this->readerRepoMock->shouldReceive('find')->andReturn(null);
        $this->bookRepoMock->shouldReceive('find')->andReturn(M::mock(Book::class));
        $command = new RegisterReaderBook('bookId', 'readerId');
        $this->handler->handle($command);
    }
}
