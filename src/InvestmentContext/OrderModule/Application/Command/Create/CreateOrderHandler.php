<?php

namespace FinizensChallenge\InvestmentContext\OrderModule\Application\Command\Create;

use FinizensChallenge\InvestmentContext\OrderModule\Domain\Model\Order;
use FinizensChallenge\InvestmentContext\OrderModule\Domain\Model\OrderRepository;
use FinizensChallenge\InvestmentContext\OrderModule\Domain\ValueObject\OrderStatus;
use FinizensChallenge\InvestmentContext\OrderModule\Domain\ValueObject\OrderType;
use FinizensChallenge\InvestmentContext\SharedModule\Application\Query\FindPortfolio\FindPortfolioQuery;
use FinizensChallenge\InvestmentContext\SharedModule\Application\Query\FindPortfolio\FindPortfolioQueryHandler;
use FinizensChallenge\InvestmentContext\SharedModule\Domain\ValueObject\Shares;
use FinizensChallenge\SharedContext\SharedModule\Domain\ValueObject\NumericId;

class CreateOrderHandler
{
    public function __construct(
        private OrderRepository $orderRepository,
        private FindPortfolioQueryHandler $findPortfolioQueryHandler,
    ) {
    }

    public function handle(CreateOrder $command): void
    {
        $this->assertExistsPortfolio($command->portfolioId());

        $orderId = new NumericId($command->orderId());
        $portfolioId = new NumericId($command->portfolioId());
        $allocationId = new NumericId($command->allocationId());
        $shares = new Shares($command->shares());
        $orderType = new OrderType($command->orderType());
        $orderStatus = OrderStatus::pending();

        $order = new Order(
            $orderId,
            $orderType,
            $portfolioId,
            $allocationId,
            $shares,
            $orderStatus
        );

        $this->orderRepository->save($order);
    }

    private function assertExistsPortfolio(string $portfolioId)
    {
        $this->findPortfolioQueryHandler->handle(FindPortfolioQuery::create($portfolioId));
    }

}
