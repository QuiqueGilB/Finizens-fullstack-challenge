<?php

namespace FinizensChallenge\InvestmentContext\OrderModule\Domain\Response;

use FinizensChallenge\InvestmentContext\OrderModule\Domain\Model\Order;
use FinizensChallenge\SharedContext\CqrsModule\Domain\Model\Response;

class OrderResponse extends Response
{
    public function __construct(
        protected int $id,
        protected int $portfolio,
        protected int $allocation,
        protected int $shares,
        protected string $type,
        protected string $status,
    ) {
    }

    public static function build($model): static
    {
        /** @var Order $model */

        return new static(
            $model->id()->value(),
            $model->portfolioId()->value(),
            $model->allocationId()->value(),
            $model->shares()->value(),
            $model->orderType()->value(),
            $model->orderStatus()->value()
        );
    }


}
