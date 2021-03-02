<?php

namespace FinizensChallenge\Tests\Behat;

use Behat\Behat\Context\Context;
use Behat\Behat\Hook\Call\BeforeScenario;
use Behat\Behat\Hook\Scope\AfterScenarioScope;
use Behat\Gherkin\Node\PyStringNode;
use Doctrine\DBAL\Connection;
use Doctrine\Persistence\ManagerRegistry;
use MongoDB\Driver\Manager;
use PHPUnit\Framework\Assert;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;

class FeatureApiContext implements Context
{
    private KernelInterface $kernel;
    private ?Response $response;
    private ManagerRegistry $managerRegistry;

    public function __construct(KernelInterface $kernel, ManagerRegistry $managerRegistry)
    {
        $this->kernel = $kernel;
        $this->managerRegistry = $managerRegistry;
    }

    /**
     * @BeforeScenario
     */
    public function cleanScenario(): void
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

    /**
     * @Given /^I send a (\w+) request to "([^"]*)" with body:$/
     */
    public function iSendARequestToWithBody(string $requestMethod, string $requestUrl, ?PyStringNode $requestBody)
    {
        $this->response = $this->kernel->handle(
            Request::create(
                $requestUrl,
                $requestMethod,
                [],
                [],
                [],
                [],
                $requestBody?->getRaw()
            )
        );
    }

    /**
     * @When /^I send a (\w+) request to "([^"]*)"$/
     */
    public function iSendAeRequestTo(string $requestMethod, string $requestUrl)
    {
        $this->response = $this->kernel->handle(
            Request::create(
                $requestUrl,
                $requestMethod
            )
        );
    }

    /**
     * @Given /^the response status code should be (\d+)$/
     */
    public function theResponseStatusCodeShouldBe(int $statusCode)
    {
        Assert::assertEquals($statusCode, $this->response->getStatusCode());
    }

    /**
     * @Given /^the response should be empty$/
     */
    public function theResponseShouldBeEmpty()
    {
        Assert::assertEmpty($this->response->getContent());
    }

    /**
     * @Given /^the response body should be:$/
     */
    public function theResponseBodyShouldBe(PyStringNode $string)
    {
        Assert::assertEquals(
            json_decode($string->getRaw(), true, 512, JSON_THROW_ON_ERROR),
            json_decode($this->response->getContent(), true, 512, JSON_THROW_ON_ERROR)
        );
    }
}