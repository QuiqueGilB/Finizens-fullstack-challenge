<?php

namespace FinizensChallenge\InvestmentContext\OrderModule\Infrastructure\Persistance\Doctrine\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use FinizensChallenge\InvestmentContext\OrderModule\Domain\Criteria\OrderCriteria;
use FinizensChallenge\InvestmentContext\OrderModule\Domain\Exception\OrderNotFoundException;
use FinizensChallenge\InvestmentContext\OrderModule\Domain\Model\Order;
use FinizensChallenge\InvestmentContext\OrderModule\Domain\Model\OrderRepository;
use FinizensChallenge\SharedContext\SharedModule\Domain\ValueObject\NumericId;
use QuiqueGilB\GlobalApiCriteria\CriteriaModule\Criteria\Application\Apply\DoctrineApplyCriteria;
use QuiqueGilB\GlobalApiCriteria\CriteriaModule\Filter\Application\Apply\DoctrineApplyFilter;

class DoctrineOrderRepository extends ServiceEntityRepository implements OrderRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Order::class);
    }

    public function byId(NumericId $orderId): ?Order
    {
        return $this->find($orderId);
    }

    public function byIdOrFail(NumericId $orderId): Order
    {
        $order = $this->byId($orderId);

        if (null === $order) {
            throw new OrderNotFoundException($orderId->value());
        }

        return $order;
    }

    public function save(Order $order): void
    {
        $this->_em->persist($order);
    }

    public function search(OrderCriteria $criteria): array
    {
        $queryBuilder = $this->baseQueryBuilder();
        DoctrineApplyCriteria::apply($queryBuilder, $criteria, self::mapFields());

        return $queryBuilder->getQuery()->getResult();
    }

    public function countSearch(OrderCriteria $criteria): int
    {
        $queryBuilder = $this->baseQueryBuilder()
            ->select('COUNT(_order)');

        DoctrineApplyFilter::apply($queryBuilder, $criteria->filters(), self::mapFields());

        return $queryBuilder->getQuery()->getSingleScalarResult();
    }

    public function byPortfolioId(NumericId $portfolioId): array
    {
        $queryBuilder = $this->baseQueryBuilder()
            ->andWhere('_order.portfolioId = :portfolioId')
            ->setParameter('portfolioId', $portfolioId->value());

        return $queryBuilder->getQuery()->getResult();
    }


    private function baseQueryBuilder(): QueryBuilder
    {
        return $this->createQueryBuilder('_order')
            ->andWhere('_order.deletedAt IS NULL');
    }

    private static function mapFields(): array
    {
        return [
            'portfolio' => '_order.portfolioId',
            'allocation' => '_order.allocationId',
            'type' => '_order.orderType.value',
            'status' => '_order.orderStatus.value',
            'createdAt' => '_order.createdAt'
        ];
    }


}
