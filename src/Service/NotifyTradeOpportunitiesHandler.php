<?php
declare(strict_types=1);

namespace ThatBook\Service;

use ThatBook\Service\HandlerInterface;
use ThatBook\Service\NotifyTradeOpportunities;
use ThatBook\Repository\ReaderRepository;

class NotifyTradeOpportunitiesHandler implements HandlerInterface
{
    /**
     * @var ReaderRepository
     */
    private $readerRepository;

    public function __construct(ReaderRepository $readerRepository)
    {
        $this->readerRepository = $readerRepository;
    }

    public function handle(NotifyTradeOpportunities $command)
    {
        // find trade opportunities
        // send email
    }
}
