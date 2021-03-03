<?php

namespace FinizensChallenge\InvestmentContext\OrderModule\Application\Command\Complete;

use FinizensChallenge\InvestmentContext\OrderModule\Domain\Exception\OrderNotFoundException;
use FinizensChallenge\InvestmentContext\OrderModule\Domain\Model\OrderRepository;
use FinizensChallenge\SharedContext\CqrsModule\Domain\Model\Command;
use FinizensChallenge\SharedContext\EventModule\Domain\Model\EventBus;
use FinizensChallenge\SharedContext\SharedModule\Domain\ValueObject\NumericId;

class CompleteOrderCommandHandler extends Command
{
    public function __construct(
        private OrderRepository $orderRepository,
        private EventBus $eventBus
    ) {
    }

    public function handle(CompleteOrderCommand $command): void
    {
        $orderId = NumericId::create($command->orderId());
        $order = $this->orderRepository->byId($orderId);

        if (null === $order) {
            throw new OrderNotFoundException($orderId->value());
        }

        $order->complete();

        $this->orderRepository->save($order);
        $this->eventBus->dispatch(...$order->eventsOccurred());
    }
}
