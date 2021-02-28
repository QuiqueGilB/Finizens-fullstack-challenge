<?php

namespace FinizensChallenge\InvestmentContext\PortfolioModule\Infrastructure\Persistance\Doctrine\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Exception\PortfolioNotFoundException;
use FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Model\Portfolio;
use FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Model\PortfolioRepository;
use FinizensChallenge\SharedContext\SharedModule\Domain\ValueObject\NumericId;

class DoctrinePortfolioRepository extends ServiceEntityRepository implements PortfolioRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Portfolio::class);
    }

    public function byId(NumericId $portfolioId): ?Portfolio
    {
        return $this->find($portfolioId->value());
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


}
