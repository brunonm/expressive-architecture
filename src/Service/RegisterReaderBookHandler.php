<?php
declare(strict_types=1);

namespace ThatBook\Service;

use ThatBook\Service\HandlerInterface;
use ThatBook\Service\RegisterReaderBook;
use ThatBook\Repository\ReaderRepository;
use ThatBook\Repository\BookRepository;
use ThatBook\Exception\ReaderNotFoundException;
use ThatBook\Exception\BookNotFoundException;
use ThatBook\Event\EventRecorder;
use ThatBook\Event\ReaderBookRegisteredEvent;

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

    /**
     * @var EventRecorder
     */
    private $eventRecorder;

    public function __construct(
        ReaderRepository $readerRepository,
        BookRepository $bookRepository,
        EventRecorder $eventRecorder
    ) {
        $this->readerRepository = $readerRepository;
        $this->bookRepository = $bookRepository;
        $this->eventRecorder = $eventRecorder;
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

        $this->eventRecorder->record(new ReaderBookRegisteredEvent($book, $reader));
    }
}
