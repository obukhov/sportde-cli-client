<?php

namespace  SportDe\CliClient\Application\Model;

class GetLineUpCommand
{
    /**
     * @var string
     */
    protected $teamId;

    /**
     * @var string
     */
    protected $seasonId;

    /**
     * @param string $seasonId
     * @param string $teamId
     */
    public function __construct($seasonId, $teamId)
    {
        $this->teamId = $teamId;
        $this->seasonId = $seasonId;
    }

    /**
     * @return string
     */
    public function getTeamId()
    {
        return $this->teamId;
    }

    /**
     * @return string
     */
    public function getSeasonId()
    {
        return $this->seasonId;
    }
}
