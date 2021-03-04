<?php

namespace FinizensChallenge\InvestmentContext\PortfolioModule\Infrastructure\Listener\Sync;

use FinizensChallenge\InvestmentContext\PortfolioModule\Application\Command\DeleteAllocation\DeleteAllocationCommand;
use FinizensChallenge\InvestmentContext\PortfolioModule\Application\Query\FindAllocation\FindAllocationByIdQuery;
use FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Event\AllocationUpdated;
use FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Response\AllocationResponse;
use FinizensChallenge\SharedContext\CqrsModule\Domain\Model\CommandBus;
use FinizensChallenge\SharedContext\CqrsModule\Domain\Model\QueryBus;
use FinizensChallenge\SharedContext\EventModule\Domain\Model\Event;
use FinizensChallenge\SharedContext\EventModule\Infrastructure\Listener\BaseSyncListener;

class DeleteAllocationWhenSharesIsZeroOnAllocationUpdatedListener extends BaseSyncListener
{
    public function __construct(
        private QueryBus $queryBus,
        private CommandBus $commandBus
    ) {
    }

    public static function subscribedEvents(): array
    {
        return [
            AllocationUpdated::eventName()
        ];
    }

    public function __invoke(Event $event): void
    {
        $allocationId = $event->data()['allocationId'];

        $allocationResponse = $this->findAllocation($allocationId);

        if (0 === $allocationResponse->shares()) {
            return;
        }

        $command = DeleteAllocationCommand::create(
            $allocationId
        );

        $this->commandBus->handle($command);
    }

    private function findAllocation(int $allocationId): AllocationResponse
    {
        $query = FindAllocationByIdQuery::create($allocationId);
        $queryResponse = $this->queryBus->handle($query);
        return $queryResponse->data()->value();
    }
}
