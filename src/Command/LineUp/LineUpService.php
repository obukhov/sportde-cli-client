<?php

namespace SportDe\CliClient\Command\LineUp;

use SportDe\CliClient\Api\Model\Match;
use SportDe\CliClient\Application\Model\Command;
use SportDe\CliClient\Application\Model\Processor;
use SportDe\CliClient\Application\Model\ResultFormatter;
use SportDe\CliClient\Command\Exception\WrongCommandException;
use SportDe\CliClient\Command\LineUp\Exception\NoCurrentMatch;
use SportDe\CliClient\Api\ApiClient;
use SportDe\CliClient\Command\LineUp\Model\LineUp;

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

        $match = $this->getCurrentMatch($command->getTeamId(), $command->getSeasonId(), $command->getCurrentDateTime());
        $lineUp = $this->getLineUpForCurrentMatch($match);

        return new LineUpFormatter($match, $lineUp);
    }

    /**
     * @param Match $resultMatch
     * @return LineUp
     */
    public function getLineUpForCurrentMatch(Match $resultMatch)
    {
        $lineUp = new LineUp();
        foreach ($this->apiClient->getMatchPlayers($resultMatch->getId()) as $matchPlayer) {
            if ('lineup' !== $matchPlayer->getKind()) {
                continue;
            }

            $lineUp
                ->addTeamLineUp($matchPlayer->getTeam())
                ->addPersonToRole($matchPlayer->getRole(), $matchPlayer->getPerson());
        }

        return $lineUp;
    }

    /**
     * @param string $teamId
     * @param string $seasonId
     * @param \DateTimeImmutable $dateTimeImmutable
     * @return Match
     * @throws NoCurrentMatch
     */
    public function getCurrentMatch($teamId, $seasonId, \DateTimeImmutable $dateTimeImmutable)
    {
        $matches = $this->apiClient->getMatches($teamId, $seasonId);
        $validTime = $dateTimeImmutable->sub(new \DateInterval('PT2H'));

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

        return $resultMatch;
    }
}
