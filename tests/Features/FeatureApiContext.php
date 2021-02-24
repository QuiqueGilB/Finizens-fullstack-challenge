<?php

namespace FinizensChallenge\Tests\Features;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;

class FeatureApiContext implements Context
{
    /**
     * @Given /^I send a (\w+) request to "([^"]*)" with body:$/
     */
    public function iSendARequestToWithBody(string $requestMethod, $requestUrl, PyStringNode $requestBody)
    {
        throw new \Behat\Behat\Tester\Exception\PendingException();
    }

    /**
     * @Given /^the response status code should be (\d+)$/
     */
    public function theResponseStatusCodeShouldBe($arg1)
    {
        throw new \Behat\Behat\Tester\Exception\PendingException();
    }

    /**
     * @Given /^the response should be empty$/
     */
    public function theResponseShouldBeEmpty()
    {
        throw new \Behat\Behat\Tester\Exception\PendingException();
    }
}