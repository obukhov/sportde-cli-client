<?php

namespace SportDe\CliClient\Commands\LineUp;

use SportDe\CliClient\Application\Model\Command;
use SportDe\CliClient\Application\Model\Processor;
use SportDe\CliClient\Application\Model\ResultFormatter;
use SportDe\CliClient\Commands\Exception\WrongCommandException;
use SportDe\CliClient\Commands\LineUp\Exception\NoCurrentMatch;
use SportDe\CliClient\Api\ApiClient;
use SportDe\CliClient\Commands\LineUp\Model\LineUp;

class LineUpService implements Processor
{
    /**
     * @var ApiClient
     */
    protected $apiClient;

    /**
     * @param ApiClient $apiClient
     */
    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    /**
     * @param Command $command
     * @return ResultFormatter
     * @throws WrongCommandException
     */
    public function process(Command $command)
    {
        if (!$command instanceof GetLineUpCommand) {
            throw new WrongCommandException();
        }

        return $this->getLineUpForCurrentMatch($command);
    }

    /**
     * @param GetLineUpCommand $lineUpCommand
     * @return ResultFormatter
     * @throws NoCurrentMatch
     */
    public function getLineUpForCurrentMatch(GetLineUpCommand $lineUpCommand)
    {
        $matches = $this->apiClient->getMatches($lineUpCommand->getTeamId(), $lineUpCommand->getSeasonId());
        $validTime = $lineUpCommand->getCurrentDateTime()->sub(new \DateInterval('PT2H'));

        $resultMatch = null;
        foreach ($matches as $match) {
            if ($match->getStartDateTime() > $validTime) {
                $resultMatch = $match;
                break;
            }
        }

        if (null === $resultMatch) {
            throw new NoCurrentMatch();
        }

        $lineUp = new LineUp();
        foreach ($this->apiClient->getMatchPlayers($resultMatch->getId()) as $matchPlayer) {
            $lineUp
                ->addTeamLineUp($matchPlayer->getTeam())
                ->addPersonToRole($matchPlayer->getRole(), $matchPlayer->getPerson());
        }

        return new LineUpFormatter($resultMatch, $lineUp);
    }
}
