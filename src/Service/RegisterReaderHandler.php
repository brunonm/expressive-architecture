<?php
declare(strict_types=1);

namespace ThatBook\Service;

use ThatBook\Service\HandlerInterface;
use ThatBook\Service\RegisterReader;
use ThatBook\Repository\ReaderRepository;
use ThatBook\Entity\Reader;

class RegisterReaderHandler implements HandlerInterface
{
    /**
     * @var ReaderRepository
     */
    private $readerRepository;

    public function __construct(ReaderRepository $readerRepository)
    {
        $this->readerRepository = $readerRepository;
    }

    public function handle(RegisterReader $command)
    {
        $this->readerRepository->store(new Reader($command->getName()));
    }
}
