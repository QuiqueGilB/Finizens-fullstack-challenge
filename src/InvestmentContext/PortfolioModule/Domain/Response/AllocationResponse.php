<?php

namespace FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Response;

use FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Model\Allocation;
use FinizensChallenge\SharedContext\CqrsModule\Query\Domain\Model\Response;

class AllocationResponse extends Response
{
    public function __construct(
        private int $id,
        private int $shares
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


}