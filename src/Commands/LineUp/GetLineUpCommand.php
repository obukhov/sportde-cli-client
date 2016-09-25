<?php

namespace SportDe\CliClient\Commands\LineUp;

use SportDe\CliClient\Application\Model\Command;

class GetLineUpCommand implements Command
{
    /**
     * @var string
     */
    protected $seasonId;

    /**
     * @var string
     */
    protected $teamId;

    /**
     * @var \DateTimeImmutable
     */
    protected $currentDateTime;

    /**
     * GetLineUpCommand constructor.
     * @param string $seasonId
     * @param string $teamId
     * @param \DateTimeImmutable $currentDateTime
     */
    public function __construct($seasonId, $teamId, \DateTimeImmutable $currentDateTime)
    {
        $this->teamId = $teamId;
        $this->seasonId = $seasonId;
        $this->currentDateTime = $currentDateTime;
    }

    /**
     * @return string
     */
    public function getSeasonId()
    {
        return $this->seasonId;
    }

    /**
     * @return string
     */
    public function getTeamId()
    {
        return $this->teamId;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getCurrentDateTime()
    {
        return $this->currentDateTime;
    }

    /**
     * @return string
     */
    public function getCommandName()
    {
        return self::class;
    }
}
