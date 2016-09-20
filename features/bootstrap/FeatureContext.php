<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Hook\Scope\AfterScenarioScope;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @BeforeScenario
     */
    public function setUpWpMock(BeforeScenarioScope $scope)
    {
        WP_Mock::setUp();
    }

    /**
     * @AfterScenario
     */
    public function tearDownWpMock(AfterScenarioScope $scope)
    {
        WP_Mock::tearDown();
    }

    /**
     * @Then tearDown should not fail
     */
    public function teardownShouldNotFail()
    {
        WP_Mock::tearDown();
    }

    /**
     * @When I do nothing
     */
    public function iDoNothing()
    {
        // Move along...
    }

    /**
     * @Then tearDown should fail
     */
    public function teardownShouldFail()
    {
        try {
            $this->teardownShouldNotFail();
            throw new PHPUnit_Framework_ExpectationFailedException('WP_Mock Teardown should have failed!');
        } catch (\Mockery\Exception\InvalidCountException $e) {
            // Move along
        }
    }
}
