<?php

namespace SportDe\CliClient\Application\Service;

use SportDe\CliClient\Application\Exception\NoCurrentMatch;
use SportDe\CliClient\Application\Model\GetLineUpCommand;
use SportDe\CliClient\Api\ApiClient;

class LineUpService
{
    /**
     * @var ApiClient
     */
    protected $apiClient;

    /**
     * LineUpService constructor.
     * @param ApiClient $apiClient
     */
    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    /**
     * @param GetLineUpCommand $lineUpCommand
     * @param \DateTimeImmutable $currentTime
     * @return \Generator|\SportDe\CliClient\Api\Model\MatchPlayer[]
     * @throws NoCurrentMatch
     */
    public function getLineUpForCurrentMatch(GetLineUpCommand $lineUpCommand, \DateTimeImmutable $currentTime)
    {
        $matches = $this->apiClient->getMatches($lineUpCommand->getTeamId(), $lineUpCommand->getSeasonId());
        $validTime = $currentTime->add(new \DateInterval('PT2H'));

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

        $players = $this->apiClient->getMatchPlayers($resultMatch->getId());
        foreach($players as $player) {
            var_dump($player);
        }
    }
}
