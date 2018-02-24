<?php
declare(strict_types=1);

namespace ThatBook\Service;

class RegisterReaderWish
{
    /**
     * @var string
     */
    private $bookId;

    /**
     * @var string
     */
    private $readerId;

    public function __construct(string $bookId, string $readerId)
    {
        $this->bookId = $bookId;
        $this->readerId = $readerId;
    }

    public function getBookId(): string
    {
        return $this->bookId;
    }

    public function getReaderId(): string
    {
        return $this->readerId;
    }
}
