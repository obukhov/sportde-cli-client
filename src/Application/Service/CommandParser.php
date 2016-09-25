<?php

namespace SportDe\CliClient\Application\Service;

use SportDe\CliClient\Api\Factory\DateTimeImmutableFactory;
use SportDe\CliClient\Application\Exception\WrongNumberOfArguments;
use SportDe\CliClient\Application\Model\Command;
use SportDe\CliClient\Commands\LineUp\GetLineUpCommand;

class CommandParser
{
    /**
     * @var DateTimeImmutableFactory
     */
    protected $dateTimeFactory;

    /**
     * @param DateTimeImmutableFactory $dateTimeFactory
     */
    public function __construct(DateTimeImmutableFactory $dateTimeFactory)
    {
        $this->dateTimeFactory = $dateTimeFactory;
    }

    /**
     * @param array $arguments
     * @return Command
     * @throws WrongNumberOfArguments
     */
    public function parse(array $arguments)
    {
        $argumentsCount = count($arguments);
        if ($argumentsCount > 4 || $argumentsCount < 3) {
            throw new WrongNumberOfArguments(count($arguments) - 1);
        }

        if (4 === $argumentsCount) {
            $currentTime = $this->dateTimeFactory->create($arguments[3], 'Y-m-d\TH:i:s');
        } else {
            $currentTime = $this->dateTimeFactory->createCurrent();
        }

        return new GetLineUpCommand($arguments[1], $arguments[2], $currentTime);
    }
}
