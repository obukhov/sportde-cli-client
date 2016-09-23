<?php

namespace SportDe\CliClient\Application;

use GuzzleHttp\Client;
use SportDe\CliClient\Api\Factory\DateTimeImmutableFactory;
use SportDe\CliClient\Api\Factory\MatchFactory;
use SportDe\CliClient\Api\Factory\MatchPlayerFactory;
use SportDe\CliClient\Application\Service\CommandParser;
use SportDe\CliClient\Application\Service\LineUpService;
use SportDe\CliClient\Application\Service\UsageHelper;
use SportDe\CliClient\Api\ApiClient;

class ServiceLocator
{
    /**
     * @return CommandParser
     */
    public function getCommandParser()
    {
        return new CommandParser();
    }

    /**
     * @return UsageHelper
     */
    public function getUsageHelper()
    {
        return new UsageHelper();
    }

    /**
     * @return LineUpService
     */
    public function getLineUpService()
    {
        return new LineUpService(
            new ApiClient(
                new Client(),
                new MatchFactory(new DateTimeImmutableFactory()),
                new MatchPlayerFactory()
            )
        );
    }
}
