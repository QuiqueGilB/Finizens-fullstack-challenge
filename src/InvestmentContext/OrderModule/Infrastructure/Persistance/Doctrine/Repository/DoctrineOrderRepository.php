<?php

namespace FinizensChallenge\InvestmentContext\OrderModule\Infrastructure\Persistance\Doctrine\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use FinizensChallenge\InvestmentContext\OrderModule\Domain\Exception\OrderNotFoundException;
use FinizensChallenge\InvestmentContext\OrderModule\Domain\Model\Order;
use FinizensChallenge\InvestmentContext\OrderModule\Domain\Model\OrderRepository;
use FinizensChallenge\SharedContext\SharedModule\Domain\ValueObject\NumericId;

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
}
