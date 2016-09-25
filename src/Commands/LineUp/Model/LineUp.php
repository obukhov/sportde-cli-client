<?php

namespace SportDe\CliClient\Commands\LineUp\Model;

use SportDe\CliClient\Api\Model\Team;

class LineUp implements \IteratorAggregate
{
    /** @var  TeamLineUp[] team lineup indexed by team id */
    protected $teamsLineup;

    /**
     * LineUp constructor.
     * @param TeamLineUp[] $teamsLineup
     */
    public function __construct(array $teamsLineup = [])
    {
        $this->teamsLineup = $teamsLineup;
    }

    /**
     * @param Team $team
     * @return TeamLineUp
     */
    public function addTeamLineUp(Team $team)
    {
        $teamId = $team->getId();

        if (!isset($this->teamsLineup[$teamId])) {
            $this->teamsLineup[$teamId] = new TeamLineUp($team);
        }

        return $this->teamsLineup[$teamId];
    }

    /**
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->teamsLineup);
    }
}
