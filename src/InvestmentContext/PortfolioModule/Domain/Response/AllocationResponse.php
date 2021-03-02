<?php

namespace FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Response;

use FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Model\Allocation;
use FinizensChallenge\SharedContext\CqrsModule\Domain\Model\Response;

class AllocationResponse extends Response
{
    public function __construct(
        protected int $id,
        protected int $shares
    ) {
    }

    public static function build($model): static
    {
        /** @var Allocation $model */
        return new static(
            $model->id()->value(),
            $model->shares()->value()
        );
    }

    public function id(): int
    {
        return $this->id;
    }

    public function shares(): int
    {
        return $this->shares;
    }

}
