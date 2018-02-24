<?php
declare(strict_types=1);

namespace ThatBook\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use ThatBook\Event\ReaderBookRegisteredEvent;
use ThatBook\Service\NotifyTradeOpportunities;
use League\Tactician\CommandBus;

class ReaderSubscriber implements EventSubscriberInterface
{
    /**
     * @var CommandBus
     */
    private $serviceBus;

    public function __construct(CommandBus $serviceBus)
    {
        $this->serviceBus = $serviceBus;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            ReaderBookRegisteredEvent::getName() => 'whenReaderBookRegistered'
        ];
    }

    public function whenReaderBookRegistered(ReaderBookRegisteredEvent $event)
    {
        $command = new NotifyTradeOpportunities();
        $this->serviceBus->handle($command);
    }
}
