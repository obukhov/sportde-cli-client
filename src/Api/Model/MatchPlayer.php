<?php

namespace SportDe\CliClient\Api\Model;

class MatchPlayer
{
    /**
     * @var Team
     */
    protected $team;

    /**
     * @var Role
     */
    protected $role;

    /**
     * @var Person
     */
    protected $person;

    /**
     * @param Team $team
     * @param Role $role
     * @param Person $person
     */
    public function __construct(Team $team, Role $role, Person $person)
    {
        $this->team = $team;
        $this->role = $role;
        $this->person = $person;
    }

    /**
     * @return Team
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * @return Role
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @return Person
     */
    public function getPerson()
    {
        return $this->person;
    }
}
