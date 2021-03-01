<?php

namespace FinizensChallenge\Tests\Behat;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use PHPUnit\Framework\Assert;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;

class FeatureApiContext implements Context
{
    private KernelInterface $kernel;
    private ?Response $response;

    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
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
        Assert::assertEquals($string->getRaw(), $this->response->getContent());
    }
}