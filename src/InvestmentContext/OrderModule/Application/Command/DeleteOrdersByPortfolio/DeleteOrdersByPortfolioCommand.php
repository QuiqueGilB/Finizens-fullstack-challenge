<?php

namespace FinizensChallenge\InvestmentContext\OrderModule\Application\Command\DeleteOrdersByPortfolio;

use FinizensChallenge\SharedContext\CqrsModule\Domain\Model\Command;

class DeleteOrdersByPortfolioCommand extends Command
{

    public static function create($portfolioId): static
    {
        return self::createFromArray([
            'portfolioId' => $portfolioId
        ]);
    }


    public function portfolioId(): string
    {
        return $this->data['portfolioId'];
    }

}
