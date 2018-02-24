<?php
declare(strict_types=1);

namespace ThatBook\Service;

use ThatBook\Service\HandlerInterface;
use ThatBook\Service\CatalogBook;
use ThatBook\Repository\BookRepository;
use ThatBook\Entity\Book;

class CatalogBookHandler implements HandlerInterface
{
    /**
     * @var BookRepository
     */
    private $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function handle(CatalogBook $command)
    {
        $book = new Book($command->getTitle(), $command->getPublisher(), $command->getCategory());

        $this->bookRepository->store($book);
    }
}
