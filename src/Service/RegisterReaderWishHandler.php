<?php
declare(strict_types=1);

namespace ThatBook\Service;

use ThatBook\Service\HandlerInterface;
use ThatBook\Service\RegisterReaderWish;
use ThatBook\Repository\ReaderRepository;
use ThatBook\Repository\BookRepository;
use ThatBook\Exception\ReaderNotFoundException;
use ThatBook\Exception\BookNotFoundException;

class RegisterReaderWishHandler implements HandlerInterface
{
    /**
     * @var ReaderRepository
     */
    private $readerRepository;

    /**
     * @var BookRepository
     */
    private $bookRepository;

    public function __construct(ReaderRepository $readerRepository, BookRepository $bookRepository)
    {
        $this->readerRepository = $readerRepository;
        $this->bookRepository = $bookRepository;
    }

    public function handle(RegisterReaderWish $command)
    {
        if (!$reader = $this->readerRepository->find($command->getReaderId())) {
            throw new ReaderNotFoundException();
        }

        if (!$book = $this->bookRepository->find($command->getBookId())) {
            throw new BookNotFoundException();
        }

        $reader->registerWish($book);

        $this->readerRepository->store($reader);
    }
}
