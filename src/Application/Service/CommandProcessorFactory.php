<?php

namespace SportDe\CliClient\Application\Service;

use SportDe\CliClient\Application\Exception\NoProcessorForCommand;
use SportDe\CliClient\Application\Model\Command;
use SportDe\CliClient\Application\Model\Processor;
use SportDe\CliClient\Application\ServiceFactory;
use SportDe\CliClient\Command\LineUp\GetLineUpCommand;

class CommandProcessorFactory
{
    /**
     * @var ServiceFactory
     */
    protected $serviceFactory;

    /**
     * @param ServiceFactory $serviceFactory
     */
    public function __construct(ServiceFactory $serviceFactory)
    {
        $this->serviceFactory = $serviceFactory;
    }

    /**
     * @param Command $command
     * @return Processor
     * @throws NoProcessorForCommand
     */
    public function getProcessor(Command $command)
    {
        switch ($command->getCommandName()) {
            case GetLineUpCommand::class:
                return $this->serviceFactory->getLineUpService();
            default:
                throw new NoProcessorForCommand($command->getCommandName());
        }
    }
}
