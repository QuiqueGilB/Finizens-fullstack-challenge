<?php

namespace FinizensChallenge\InvestmentContext\PortfolioModule\Infrastructure\Persistance\Doctrine\Fixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Model\Allocation;
use FinizensChallenge\InvestmentContext\PortfolioModule\Domain\Model\Portfolio;
use FinizensChallenge\InvestmentContext\SharedModule\Domain\ValueObject\Shares;
use FinizensChallenge\SharedContext\SharedModule\Domain\ValueObject\NumericId;

class PortfolioFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $portfolio = new Portfolio(new NumericId(10000));
        $portfolio->update(
            new Allocation(new NumericId(10000),$portfolio, new Shares(50)),
            new Allocation(new NumericId(10001),$portfolio, new Shares(21)),
            new Allocation(new NumericId(10002),$portfolio, new Shares(67))
        );
        $manager->persist($portfolio);

        $portfolio = new Portfolio(new NumericId(10001));
        $portfolio->update(
            new Allocation(new NumericId(10003),$portfolio, new Shares(21)),
            new Allocation(new NumericId(10004),$portfolio, new Shares(251)),
        );
        $manager->persist($portfolio);

        $portfolio = new Portfolio(new NumericId(10002));
        $portfolio->update(
            new Allocation(new NumericId(10005),$portfolio, new Shares(67)),
            new Allocation(new NumericId(10006),$portfolio, new Shares(32)),
            new Allocation(new NumericId(10007),$portfolio, new Shares(7)),
            new Allocation(new NumericId(10008),$portfolio, new Shares(89)),
            new Allocation(new NumericId(10009),$portfolio, new Shares(632)),
            new Allocation(new NumericId(10010),$portfolio, new Shares(133)),
        );
        $manager->persist($portfolio);


        $manager->flush();
    }

}
