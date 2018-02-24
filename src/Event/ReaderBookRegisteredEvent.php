<?php
declare(strict_types=1);

namespace ThatBook\Event;

use ThatBook\Entity\Book;
use ThatBook\Entity\Reader;

class ReaderBookRegisteredEvent extends AbstractEvent
{
    /**
     * @var Book
     */
    private $book;

    /**
     * @var Reader
     */
    private $reader;

    /**
     * @var \DateTime
     */
    private $createdAt;

    public function __construct(Book $book, Reader $reader)
    {
        $this->book = $book;
        $this->reader = $reader;
        $this->createdAt = new \DateTime();
    }

    public function getBook(): Book
    {
        return $this->book;
    }

    public function getReader(): Reader
    {
        return $this->reader;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public static function getName(): string
    {
        return 'reader_book.registered';
    }
}
