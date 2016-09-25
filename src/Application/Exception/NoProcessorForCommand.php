<?php

namespace SportDe\CliClient\Application\Exception;

class NoProcessorForCommand extends \Exception
{
    /**
     * @var string
     */
    protected $commandName;

    /**
     * @param $commandName
     */
    public function __construct($commandName)
    {
        $this->commandName = $commandName;
        parent::__construct(sprintf('Command processor for %s not defined', $commandName));
    }

    /**
     * @return string
     */
    public function getCommandName()
    {
        return $this->commandName;
    }
}
