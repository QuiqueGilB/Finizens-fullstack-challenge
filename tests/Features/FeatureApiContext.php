<?php

namespace FinizensChallenge\Tests\Features;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use FinizensChallenge\SharedContext\SymfonyModule\Kernel\Kernel;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class FeatureApiContext extends WebTestCase implements Context
{
    private  static KernelBrowser $client;
    private Response $response;

    protected static function getKernelClass(): string
    {
        return Kernel::class;
    }

    /** @BeforeFeature */
    public static function prepareForTheScenario()
    {
        self::$client = static::createClient();
    }

    /**
     * @Given /^I send a (\w+) request to "([^"]*)" with body:$/
     */
    public function iSendARequestToWithBody(string $requestMethod, string $requestUrl, ?PyStringNode $requestBody)
    {
        static::$client->request($requestMethod, $requestUrl, [], [], [], $requestBody->getRaw());
        $this->response = self::$client->getResponse();
    }

    /**
     * @When /^I send a (\w+) request to "([^"]*)"$/
     */
    public function iSendARequestTo(string $requestMethod, string $requestUrl)
    {
        self::$client->request($requestMethod, $requestUrl);
        $this->response = self::$client->getResponse();
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