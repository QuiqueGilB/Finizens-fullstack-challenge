<?php

namespace FinizensChallenge\InvestmentContext\PortfolioModule\Infrastructure\Listener\Sync;

use FinizensChallenge\InvestmentContext\OrderModule\Domain\Event\OrderCompleted;
use FinizensChallenge\InvestmentContext\OrderModule\Domain\Exception\AllocationNotFoundException;
use FinizensChallenge\InvestmentContext\PortfolioModule\Application\Command\CreateOrUpdateAllocation\UpdateAllocationCommand;
use FinizensChallenge\InvestmentContext\PortfolioModule\Application\Query\FindAllocation\FindAllocationByIdQuery;
use FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Response\AllocationResponse;
use FinizensChallenge\SharedContext\CqrsModule\Domain\Model\CommandBus;
use FinizensChallenge\SharedContext\CqrsModule\Domain\Model\QueryBus;
use FinizensChallenge\SharedContext\EventModule\Domain\Model\Event;
use FinizensChallenge\SharedContext\EventModule\Infrastructure\Listener\BaseSyncListener;

class ManageAllocationOnOrderCompletedListener extends BaseSyncListener
{
    public function __construct(
        private QueryBus $queryBus,
        private CommandBus $commandBus
    ) {
    }

    public static function subscribedEvents(): array
    {
        return [
            OrderCompleted::eventName()
        ];
    }


    public function __invoke(Event $event): void
    {
        $portfolioId = $event->data()['portfolioId'];
        $allocationId = $event->data()['allocationId'];
        $orderType = $event->data()['orderType'];
        $shares = $event->data()['shares'];

        $allocationResponse = $this->findAllocation($allocationId);

        if (null !== $allocationResponse) {
            $shares += $allocationResponse->shares() * 'sell' === $orderType ? -1 : 1;
        }

        $command = UpdateAllocationCommand::create(
            $portfolioId,
            $allocationId,
            $shares,
        );

        $this->commandBus->handle($command);
    }

    private function findAllocation(int $allocationId): ?AllocationResponse
    {
        $query = FindAllocationByIdQuery::create($allocationId);
        try {
            $queryResponse = $this->queryBus->handle($query);
            return $queryResponse->data()->value();

        } catch (AllocationNotFoundException $exception) {
            return null;
        }
    }
}
