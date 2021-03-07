<?php

namespace FinizensChallenge\InvestmentContext\PortfolioModule\Infrastructure\Persistance\Doctrine\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Criteria\PortfolioCriteria;
use FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Exception\PortfolioNotFoundException;
use FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Model\Allocation;
use FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Model\Portfolio;
use FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Model\PortfolioRepository;
use FinizensChallenge\SharedContext\SharedModule\Domain\ValueObject\NumericId;
use QuiqueGilB\GlobalApiCriteria\CriteriaModule\Criteria\Application\Apply\DoctrineApplyCriteria;
use QuiqueGilB\GlobalApiCriteria\CriteriaModule\Filter\Application\Apply\DoctrineApplyFilter;

class DoctrinePortfolioRepository extends ServiceEntityRepository implements PortfolioRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Portfolio::class);
    }

    public function byId(NumericId $portfolioId): ?Portfolio
    {
        return $this->find($portfolioId);
    }

    public function allocationById(NumericId $allocationId): ?Allocation
    {
        return $this->_em->find(Allocation::class, $allocationId);
    }

    public function byIdOrFail(NumericId $portfolioId): Portfolio
    {
        $portfolio = $this->byId($portfolioId);

        if (null === $portfolio) {
            throw new PortfolioNotFoundException($portfolioId->value());
        }

        return $portfolio;
    }

    public function save(Portfolio $portfolio): void
    {
        $this->_em->persist($portfolio);
    }

    public function search(PortfolioCriteria $portfolioCriteria): array
    {
        $queryBuilder = $this->baseCriteriaQuery();

        DoctrineApplyCriteria::apply($queryBuilder, $portfolioCriteria, self::mapFields());
        return $queryBuilder->getQuery()->getResult();
    }

    public function countSearch(PortfolioCriteria $portfolioCriteria): int
    {
        $queryBuilder = $this->baseCriteriaQuery()
            ->select('COUNT(portfolio)');

        DoctrineApplyFilter::apply($queryBuilder, $portfolioCriteria->filters(), self::mapFields());
        return $queryBuilder->getQuery()->getSingleScalarResult();
    }

    private function baseCriteriaQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('portfolio');
    }

    private static function mapFields(): array
    {
        return [
            'createdAt' => 'portfolio.createdAt'
        ];
    }


}
