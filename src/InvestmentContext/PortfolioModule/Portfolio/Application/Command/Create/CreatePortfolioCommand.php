<?php

namespace FinizensChallenge\InvestmentContext\PortfolioModule\Portfolio\Application\Command\Create;

use FinizensChallenge\SharedContext\CqrsModule\Command\Domain\Model\Command;

class CreatePortfolioCommand extends Command
{
    public static function create($portfolioId, $allocations): static
    {
        return parent::createFromArray([
            'id' => $portfolioId,
            'allocations' => $allocations
        ]);
    }

    public function portfolioId(): string
    {
        return $this->data['id'];
    }

    public function allocations(): array
    {
        return $this->data['allocations'];
    }
}
