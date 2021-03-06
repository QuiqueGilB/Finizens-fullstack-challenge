<?php

namespace FinizensChallenge\InvestmentContext\OrderModule\Application\Command\Create;

use FinizensChallenge\InvestmentContext\OrderModule\Domain\Exception\AllocationNotFoundException;
use FinizensChallenge\InvestmentContext\OrderModule\Domain\Exception\OrderAllocationExceededSharesLimitException;
use FinizensChallenge\InvestmentContext\OrderModule\Domain\Model\Order;
use FinizensChallenge\InvestmentContext\OrderModule\Domain\Model\OrderRepository;
use FinizensChallenge\InvestmentContext\OrderModule\Domain\ValueObject\OrderStatus;
use FinizensChallenge\InvestmentContext\OrderModule\Domain\ValueObject\OrderType;
use FinizensChallenge\InvestmentContext\SharedModule\Application\Query\FindPortfolio\FindPortfolioQuery;
use FinizensChallenge\InvestmentContext\SharedModule\Application\Query\FindPortfolio\FindPortfolioQueryHandler;
use FinizensChallenge\InvestmentContext\SharedModule\Domain\Response\AllocationResponse;
use FinizensChallenge\InvestmentContext\SharedModule\Domain\Response\PortfolioResponse;
use FinizensChallenge\InvestmentContext\SharedModule\Domain\ValueObject\Shares;
use FinizensChallenge\SharedContext\EventModule\Domain\Model\EventBus;
use FinizensChallenge\SharedContext\SharedModule\Domain\ValueObject\NumericId;

class CreateOrderCommandHandler
{
    public function __construct(
        private OrderRepository $orderRepository,
        private FindPortfolioQueryHandler $findPortfolioQueryHandler,
        private EventBus $eventBus
    ) {
    }

    public function handle(CreateOrderCommand $command): void
    {
        $portfolioResponseData = $this->findPortfolio($command);

        $orderId = new NumericId($command->orderId());
        $portfolioId = new NumericId($command->portfolioId());
        $allocationId = new NumericId($command->allocationId());
        $shares = new Shares($command->shares());
        $orderType = new OrderType($command->orderType());
        $orderStatus = OrderStatus::pending();

        if ($orderType->isSell()) {
            $allocationResponse = $this->findAllocation($allocationId, $portfolioResponseData);
            $this->assertSharesNotExcededLimit($shares, $allocationResponse);
        }

        $order = new Order(
            $orderId,
            $orderType,
            $portfolioId,
            $allocationId,
            $shares,
            $orderStatus
        );

        $this->orderRepository->save($order);
        $this->eventBus->dispatch(...$order->pullEventsOccurred());
    }

    private function findPortfolio(CreateOrderCommand $command): PortfolioResponse
    {
        return $this->findPortfolioQueryHandler
            ->handle(
                FindPortfolioQuery::create($command->portfolioId())
            )
            ->data()
            ->value();
    }

    private function findAllocation(
        NumericId $allocationId,
        PortfolioResponse $portfolioResponseData
    ): AllocationResponse {

        foreach ($portfolioResponseData->allocationResponses() as $allocationResponse) {
            if ($allocationId->value() === $allocationResponse->id()) {
                return $allocationResponse;
            }
        }

        throw new AllocationNotFoundException($allocationId->value());
    }

    private function assertSharesNotExcededLimit(
        Shares $shares,
        AllocationResponse $allocationResponse
    ) {
        if ($shares->value() > $allocationResponse->shares()) {
            throw new OrderAllocationExceededSharesLimitException();
        }
    }


}
