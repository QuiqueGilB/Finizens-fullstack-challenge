<?php

namespace FinizensChallenge\InvestmentContext\OrderModule\Infrastructure\Persistance\Doctrine\Fixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use FinizensChallenge\InvestmentContext\OrderModule\Domain\Model\Order;
use FinizensChallenge\InvestmentContext\OrderModule\Domain\ValueObject\OrderStatus;
use FinizensChallenge\InvestmentContext\OrderModule\Domain\ValueObject\OrderType;
use FinizensChallenge\InvestmentContext\SharedModule\Domain\ValueObject\Shares;
use FinizensChallenge\SharedContext\SharedModule\Domain\ValueObject\NumericId;

class OrderFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $manager->persist(new Order(
            new NumericId(10000),
            new OrderType('sell'),
            new NumericId(10000),
            new NumericId(10000),
            new Shares(10),
            new OrderStatus('completed')
        ));
        $manager->persist(new Order(
            new NumericId(10001),
            new OrderType('sell'),
            new NumericId(10000),
            new NumericId(10001),
            new Shares(10),
            new OrderStatus('pending')
        ));
        $manager->persist(new Order(
            new NumericId(10002),
            new OrderType('buy'),
            new NumericId(10000),
            new NumericId(10001),
            new Shares(214),
            new OrderStatus('completed')
        ));
        $manager->persist(new Order(
            new NumericId(10003),
            new OrderType('sell'),
            new NumericId(10000),
            new NumericId(100002),
            new Shares(546),
            new OrderStatus('completed')
        ));
        $manager->persist(new Order(
            new NumericId(10004),
            new OrderType('sell'),
            new NumericId(10001),
            new NumericId(10004),
            new Shares(65),
            new OrderStatus('pending')
        ));


        $manager->persist(new Order(
            new NumericId(10005),
            new OrderType('sell'),
            new NumericId(10001),
            new NumericId(10003),
            new Shares(76),
            new OrderStatus('pending')
        ));

        $manager->persist(new Order(
            new NumericId(10006),
            new OrderType('buy'),
            new NumericId(10001),
            new NumericId(10004),
            new Shares(23),
            new OrderStatus('completed')
        ));


        $manager->persist(new Order(
            new NumericId(10007),
            new OrderType('buy'),
            new NumericId(10002),
            new NumericId(10007),
            new Shares(56),
            new OrderStatus('completed')
        ));
        $manager->persist(new Order(
            new NumericId(10008),
            new OrderType('buy'),
            new NumericId(10002),
            new NumericId(10009),
            new Shares(552),
            new OrderStatus('pending')
        ));

        $manager->persist(new Order(
            new NumericId(10009),
            new OrderType('buy'),
            new NumericId(10002),
            new NumericId(10010),
            new Shares(42),
            new OrderStatus('completed')
        ));
        $manager->persist(new Order(
            new NumericId(10010),
            new OrderType('sell'),
            new NumericId(10002),
            new NumericId(10011),
            new Shares(10),
            new OrderStatus('pending')
        ));
        $manager->persist(new Order(
            new NumericId(10011),
            new OrderType('sell'),
            new NumericId(10002),
            new NumericId(10010),
            new Shares(32),
            new OrderStatus('completed')
        ));
        $manager->persist(new Order(
            new NumericId(10012),
            new OrderType('sell'),
            new NumericId(10002),
            new NumericId(10008),
            new Shares(2),
            new OrderStatus('completed')
        ));

        $manager->flush();
    }


}
