<?php
declare(strict_types=1);

namespace ThatBook\Service\Reader;

use ThatBook\Service\HandlerInterface;
use ThatBook\Service\Reader\RegisterReaderBook;
use ThatBook\Repository\ReaderRepository;
use ThatBook\Repository\BookRepository;
use ThatBook\Exception\ReaderNotFoundException;
use ThatBook\Exception\BookNotFoundException;

class RegisterReaderBookHandler implements HandlerInterface
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

    public function handle(RegisterReaderBook $command)
    {
        if (!$reader = $this->readerRepository->find($command->getReaderId())) {
            throw new ReaderNotFoundException();
        }

        if (!$book = $this->bookRepository->find($command->getBookId())) {
            throw new BookNotFoundException();
        }

        $reader->registerBook($book);

        $this->readerRepository->store($reader);
    }
}
