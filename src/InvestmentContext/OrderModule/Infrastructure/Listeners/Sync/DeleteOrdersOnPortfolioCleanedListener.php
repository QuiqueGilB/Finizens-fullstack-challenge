<?php

namespace FinizensChallenge\InvestmentContext\OrderModule\Infrastructure\Listeners\Sync;

use FinizensChallenge\InvestmentContext\OrderModule\Application\Command\DeleteOrdersByPortfolio\DeleteOrdersByPortfolioCommand;
use FinizensChallenge\InvestmentContext\OrderModule\Application\Command\DeleteOrdersByPortfolio\DeleteOrdersByPortfolioCommandHandler;
use FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Event\PortfolioCleaned;
use FinizensChallenge\SharedContext\EventModule\Domain\Model\Event;
use FinizensChallenge\SharedContext\EventModule\Infrastructure\Listener\BaseSyncListener;

class DeleteOrdersOnPortfolioCleanedListener extends BaseSyncListener
{
    public function __construct(private DeleteOrdersByPortfolioCommandHandler $deleteOrdersByPortfolioCommandHandler)
    {
    }

    public static function subscribedTo(): array
    {
        return [PortfolioCleaned::eventName()];
    }

    public function __invoke(Event $event): void
    {
        $command = DeleteOrdersByPortfolioCommand::create(
            $event->data()['id']
        );

        $this->deleteOrdersByPortfolioCommandHandler->handle($command);
    }


}
