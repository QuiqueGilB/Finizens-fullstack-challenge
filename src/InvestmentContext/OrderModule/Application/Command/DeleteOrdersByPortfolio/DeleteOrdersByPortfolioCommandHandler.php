<?php

namespace FinizensChallenge\InvestmentContext\OrderModule\Application\Command\DeleteOrdersByPortfolio;

use FinizensChallenge\InvestmentContext\OrderModule\Domain\Model\OrderRepository;
use FinizensChallenge\SharedContext\EventModule\Domain\Model\EventBus;
use FinizensChallenge\SharedContext\SharedModule\Domain\ValueObject\NumericId;

class DeleteOrdersByPortfolioCommandHandler
{

    public function __construct(
        private OrderRepository $orderRepository,
        private EventBus $eventBus
    ) {
    }

    public function handle(DeleteOrdersByPortfolioCommand $command): void
    {
        $portfolioId = new NumericId($command->portfolioId());
        $orders = $this->orderRepository->byPortfolioId($portfolioId);

        foreach ($orders as $order) {
            $order->delete();
            $this->orderRepository->save($order);
            $this->eventBus->dispatch(...$order->pullEventsOccurred());
        }
    }

}
