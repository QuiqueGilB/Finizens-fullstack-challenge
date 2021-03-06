<?php

namespace FinizensChallenge\InvestmentContext\PortfolioModule\Infrastructure\Listener\Sync;

use FinizensChallenge\InvestmentContext\PortfolioModule\Application\Command\DeleteAllocation\DeleteAllocationCommand;
use FinizensChallenge\InvestmentContext\PortfolioModule\Application\Command\DeleteAllocation\DeleteAllocationCommandHandler;
use FinizensChallenge\InvestmentContext\PortfolioModule\Application\Query\FindAllocation\FindAllocationByIdQuery;
use FinizensChallenge\InvestmentContext\PortfolioModule\Application\Query\FindAllocation\FindAllocationByIdQueryHandler;
use FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Event\AllocationUpdated;
use FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Response\AllocationResponse;
use FinizensChallenge\SharedContext\CqrsModule\Domain\Model\CommandBus;
use FinizensChallenge\SharedContext\CqrsModule\Domain\Model\QueryBus;
use FinizensChallenge\SharedContext\EventModule\Domain\Model\Event;
use FinizensChallenge\SharedContext\EventModule\Infrastructure\Listener\BaseSyncListener;

class DeleteAllocationWhenSharesIsZeroOnAllocationUpdatedListener extends BaseSyncListener
{
    public function __construct(
        private FindAllocationByIdQueryHandler $findAllocationByIdQueryHandler,
        private DeleteAllocationCommandHandler $deleteAllocationCommandHandler
    ) {
    }

    public static function subscribedTo(): array
    {
        return [
            AllocationUpdated::eventName()
        ];
    }

    public function __invoke(Event $event): void
    {
        $allocationId = $event->data()['id'];

        $allocationResponse = $this->findAllocation($allocationId);

        if (0 !== $allocationResponse->shares()) {
            return;
        }

        $command = DeleteAllocationCommand::create(
            $allocationId
        );

        $this->deleteAllocationCommandHandler->handle($command);
    }

    private function findAllocation(int $allocationId): AllocationResponse
    {
        $query = FindAllocationByIdQuery::create($allocationId);
        $queryResponse = $this->findAllocationByIdQueryHandler->handle($query);
        return $queryResponse->data()->value();
    }
}
