<?php

namespace FinizensChallenge\InvestmentContext\PortfolioModule\Portfolio\Domain\Model;

use FinizensChallenge\SharedContext\SharedModule\Entity\Domain\Model\Entity;
use FinizensChallenge\SharedContext\SharedModule\Id\Domain\ValueObject\NumericId;

class Portfolio extends Entity
{
    /** @var Allocation[]  */
    private array $allocations;

    public function __construct(NumericId $id, Allocation ...$allocations)
    {
        parent::__construct($id);
        $this->allocations = $allocations;
    }

    public function allocations(): array
    {
        return $this->allocations;
    }

}
