<?php

namespace SportDe\CliClient;

use SportDe\CliClient\Application\ServiceLocator;

class Application
{
    /**
     * @var ServiceLocator
     */
    protected $services;

    /**
     * @param ServiceLocator $services
     */
    public function __construct(ServiceLocator $services)
    {
        $this->services = $services;
    }

    public function process(array $arguments)
    {
        try {
            $command = $this->services->getCommandParser()->parse($arguments);
            $players = $this->services->getLineUpService()->getLineUpForCurrentMatch($command, new \DateTimeImmutable());

            foreach($players as $player) {
                var_dump($player);
            }

        } catch (\Exception $e) {
            echo $this->services->getUsageHelper()->format($e);
            exit(1);
        }
    }
}
