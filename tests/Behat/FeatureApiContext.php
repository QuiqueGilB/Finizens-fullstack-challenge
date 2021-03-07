<?php

namespace FinizensChallenge\Tests\Behat;

use Behat\Behat\Hook\Call\BeforeScenario;
use Behat\Gherkin\Node\PyStringNode;
use PHPUnit\Framework\Assert;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FeatureApiContext extends BaseContext
{
    private ?Response $response;

    /**
     * @BeforeScenario
     */
    public function cleanScenario(): void
    {
        $this->truncateTables();
        $this->loadFixtures();
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
                [
                    'CONTENT_TYPE' => 'application/json',
                ],
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