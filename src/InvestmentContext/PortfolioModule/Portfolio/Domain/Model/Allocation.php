<?php

namespace FinizensChallenge\InvestmentContext\PortfolioModule\Porfolio\Domain\Model;

use FinizensChallenge\InvestmentContext\PortfolioModule\Porfolio\Domain\ValueObject\Shares;
use FinizensChallenge\SharedContext\SharedModule\Entity\Domain\Model\Entity;
use FinizensChallenge\SharedContext\SharedModule\Id\Domain\ValueObject\NumericId;

class Allocation extends Entity
{
    private Shares $shares;

    public function __construct(NumericId $id, Shares $shares)
    {
        parent::__construct($id);
        $this->shares = $shares;
    }

    public function shares(): Shares
    {
        return $this->shares;
    }
}
