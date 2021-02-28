<?php

namespace FinizensChallenge\Tests\Features;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use FinizensChallenge\SharedContext\SymfonyModule\Kernel\Kernel;
use Psr\Http\Message\ResponseInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class FeatureApiContext extends WebTestCase implements Context
{
    private KernelBrowser $client;
    private Response $response;

    protected static function getKernelClass(): string
    {
        return Kernel::class;
    }

    /** @BeforeScenario */
    public function prepareForTheScenario()
    {
        $this->client = static::createClient();
    }

    /**
     * @Given /^I send a (\w+) request to "([^"]*)" with body:$/
     */
    public function iSendARequestToWithBody(string $requestMethod, string $requestUrl, PyStringNode $requestBody)
    {
        $this->client->request($requestMethod, $requestUrl, [], [], [], $requestBody->getRaw());
        $this->response = $this->client->getResponse();
    }

    /**
     * @When /^I send a (\w+) request to "([^"]*)"$/
     */
    public function iSendARequestTo(string $requestMethod, string $requestUrl)
    {
        $this->client->request($requestMethod, $requestUrl);
        $this->response = $this->client->getResponse();
    }


    /**
     * @Given /^the response status code should be (\d+)$/
     */
    public function theResponseStatusCodeShouldBe(int $statusCode)
    {
        self::assertEquals($statusCode, $this->response->getStatusCode());
    }

    /**
     * @Given /^the response should be empty$/
     */
    public function theResponseShouldBeEmpty()
    {
        self::assertEmpty($this->response->getContent());
    }

    /**
     * @Given /^the response body should be:$/
     */
    public function theResponseBodyShouldBe(PyStringNode $string)
    {
        self::assertEquals($string->getRaw(), $this->response->getContent());
    }
}