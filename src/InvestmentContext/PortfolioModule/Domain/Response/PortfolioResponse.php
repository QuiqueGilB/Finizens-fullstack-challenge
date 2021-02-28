<?php

namespace FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Response;

use FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Model\Portfolio;
use FinizensChallenge\SharedContext\CqrsModule\Domain\Model\Response;

class PortfolioResponse extends Response
{
    public function __construct(
        private int $id,
        private array $allocations
    ) {
    }

    public static function build($model): static
    {
        /** @var Portfolio $model */
        return new static(
            $model->id()->value(),
            AllocationResponse::buildCollection($model->allocations())
        );
    }

}
