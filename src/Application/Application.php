<?php

namespace SportDe\CliClient\Application;

class Application
{
    /**
     * @var ServiceFactory
     */
    protected $services;

    /**
     * @param ServiceFactory $services
     */
    public function __construct(ServiceFactory $services)
    {
        $this->services = $services;
    }

    public function run(array $arguments)
    {
        try {
            $command = $this->services->getCommandParser()->parse($arguments);
            $result = $this->services->getCommandProcessorFactory()
                ->getProcessor($command)
                ->process($command);

            echo $result->format();
            return 0;
        } catch (\Exception $e) {
            echo $this->services->getUsageHelper($e, $arguments[0])->format();
            return 1;
        }
    }
}
