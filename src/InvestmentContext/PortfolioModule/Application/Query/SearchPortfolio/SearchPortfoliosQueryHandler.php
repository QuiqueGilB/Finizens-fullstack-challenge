<?php

namespace FinizensChallenge\InvestmentContext\PortfolioModule\Application\Query\SearchPortfolio;

use FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Criteria\PortfolioCriteria;
use FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Model\PortfolioRepository;
use FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Response\PortfolioResponse;
use FinizensChallenge\SharedContext\CqrsModule\Domain\Model\QueryMetadata;
use FinizensChallenge\SharedContext\CqrsModule\Domain\Model\QueryResponse;
use QuiqueGilB\GlobalApiCriteria\CriteriaModule\Paginate\Domain\ValueObject\Paginate;

class SearchPortfoliosQueryHandler
{
    public function __construct(
        private PortfolioRepository $portfolioRepository
    ) {
    }

    public function handle(SearchPortfoliosQuery $query): QueryResponse
    {
        $portfolioCriteria = PortfolioCriteria::create()
            ->withFilter($query->filters())
            ->withOrder($query->order())
            ->withPaginate(Paginate::create($query->offset(), $query->limit()));

        $portfolios = $this->portfolioRepository->search($portfolioCriteria);
        $countPortfolios = $this->portfolioRepository->countSearch($portfolioCriteria);

        return new QueryResponse(
            PortfolioResponse::buildCollection($portfolios),
            QueryMetadata::create($query->offset(), $query->limit(), $countPortfolios)
        );
    }

}
