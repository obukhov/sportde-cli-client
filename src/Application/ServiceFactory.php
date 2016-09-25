<?php

namespace SportDe\CliClient\Application;

use GuzzleHttp\Client;
use SportDe\CliClient\Api\Factory\DateTimeImmutableFactory;
use SportDe\CliClient\Api\Factory\MatchFactory;
use SportDe\CliClient\Api\Factory\MatchPlayerFactory;
use SportDe\CliClient\Application\Service\CommandParser;
use SportDe\CliClient\Application\Service\CommandProcessorFactory;
use SportDe\CliClient\Commands\LineUp\LineUpService;
use SportDe\CliClient\Application\Model\UsageHelper;
use SportDe\CliClient\Api\ApiClient;

class ServiceFactory
{
    /**
     * @return CommandParser
     */
    public function getCommandParser()
    {
        return new CommandParser(new DateTimeImmutableFactory());
    }

    /**
     * @return CommandProcessorFactory
     */
    public function getCommandProcessorFactory()
    {
        return new CommandProcessorFactory($this);
    }

    /**
     * @param \Exception $exception
     * @return UsageHelper
     */
    public function getUsageHelper(\Exception $exception)
    {
        return new UsageHelper($exception);
    }

    /**
     * @return LineUpService
     */
    public function getLineUpService()
    {
        return new LineUpService($this->getApiClient());
    }

    /**
     * @return ApiClient
     */
    protected function getApiClient()
    {
        return new ApiClient(
            new Client(),
            new MatchFactory(new DateTimeImmutableFactory()),
            new MatchPlayerFactory()
        );
    }
}
