<?php

namespace FinizensChallenge\Tests\Behat;

use Behat\Behat\Context\Context;
use Doctrine\DBAL\Driver\Connection;
use Doctrine\Persistence\ManagerRegistry;
use RuntimeException;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\HttpKernel\KernelInterface;

class BaseContext implements Context
{
    protected KernelInterface $kernel;
    protected Application $console;

    private ManagerRegistry $managerRegistry;

    public function __construct(KernelInterface $kernel, ManagerRegistry $managerRegistry)
    {
        $this->kernel = $kernel;
        $this->managerRegistry = $managerRegistry;
        $this->console = new Application($this->kernel);
        $this->console->setAutoExit(false);
    }

    protected function loadFixtures(): void
    {
//        $this->console->run(new StringInput('doctrine:fixtures:load -n'));

        $command = sprintf(
            '%s/bin/console doctrine:fixtures:load -n -e %s',
            $this->kernel->getProjectDir(),
            $this->kernel->getEnvironment()
        );

        exec($command, $output, $exitCode);

        $this->managerRegistry->resetManager();

        if (0 !== $exitCode) {
            throw new RuntimeException(implode("\r\n", $output), $exitCode);
        }
    }

    protected function truncateTables(): void
    {

        /** @var Connection $connection */
        foreach ($this->managerRegistry->getConnections() as $connection) {

            $tableNames = $connection->getSchemaManager()->listTableNames();
            $sqlTruncates = array_map(
                static function (string $tablename) {
                    return sprintf("TRUNCATE TABLE %s;", $tablename);
                },
                $tableNames
            );

            $sql = sprintf("
                SET FOREIGN_KEY_CHECKS = 0;
                %s
                SET FOREIGN_KEY_CHECKS = 1;",
                implode(' ', $sqlTruncates));

            $connection->executeStatement($sql);
        }
    }
}
