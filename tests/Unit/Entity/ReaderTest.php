<?php
declare(strict_types=1);

namespace ThatBook\Tests\Unit\Entity;

use ThatBook\Tests\Unit\AbstractUnitTestCase;
use ThatBook\Entity\Reader;
use ThatBook\Entity\Book;
use \Mockery as M;

class ReaderTest extends AbstractUnitTestCase
{
    public function testShouldRegisterAReaderBook()
    {
        $book = M::mock(Book::class);

        $reader = new Reader('Bruno');
        $reader->registerBook($book);

        $this->assertCount(1, $reader->getBooks());
    }

    public function testShouldNotRegisterReaderBookTwice()
    {
        $book = M::mock(Book::class);

        $reader = new Reader('Bruno');
        $reader->registerBook($book);
        $reader->registerBook($book);

        $this->assertCount(1, $reader->getBooks());
    }

    public function testShouldRemoveWishWhenRegisterTheBook()
    {
        $book = M::mock(Book::class);

        $reader = new Reader('Bruno');
        $reader->registerWish($book);
        $reader->registerBook($book);

        $this->assertCount(0, $reader->getWishlist());
    }

    public function testShouldRegisterAReaderWish()
    {
        $book = M::mock(Book::class);

        $reader = new Reader('Bruno');
        $reader->registerBook($book);

        $this->assertCount(1, $reader->getBooks());
    }

    /**
     * @expectedException \ThatBook\Exception\ReaderAlreadyHasBookException
     */
    public function testShouldThrowExceptionIfReaderAlreadyHasBookWhenRegisterWish()
    {
        $book = M::mock(Book::class);

        $reader = new Reader('Bruno');
        $reader->registerBook($book);
        $reader->registerWish($book);
    }
}
