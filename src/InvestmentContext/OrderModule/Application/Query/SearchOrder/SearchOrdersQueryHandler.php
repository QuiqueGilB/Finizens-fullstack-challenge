<?php

namespace FinizensChallenge\InvestmentContext\OrderModule\Application\Query\SearchOrder;

use FinizensChallenge\InvestmentContext\OrderModule\Domain\Criteria\OrderCriteria;
use FinizensChallenge\InvestmentContext\OrderModule\Domain\Model\OrderRepository;
use FinizensChallenge\InvestmentContext\OrderModule\Domain\Response\OrderResponse;
use FinizensChallenge\SharedContext\CqrsModule\Domain\Model\QueryMetadata;
use FinizensChallenge\SharedContext\CqrsModule\Domain\Model\QueryResponse;
use QuiqueGilB\GlobalApiCriteria\CriteriaModule\Paginate\Domain\ValueObject\Paginate;

class SearchOrdersQueryHandler
{
    public function __construct(
        private OrderRepository $orderRepository
    ) {
    }

    public function handle(SearchOrdersQuery $query): QueryResponse
    {
        $orderCriteria = OrderCriteria::create()
            ->withFilter($query->filters())
            ->withOrder($query->order())
            ->withPaginate(Paginate::create($query->offset(), $query->limit()));

        $orders = $this->orderRepository->search($orderCriteria);
        $countOrders = $this->orderRepository->countSearch($orderCriteria);

        return new QueryResponse(
            OrderResponse::buildCollection($orders),
            new QueryMetadata($query->offset(), $query->limit(), $countOrders)
        );
    }
}
