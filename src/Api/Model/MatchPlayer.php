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
     * @var string
     */
    protected $kind;

    /**
     * @param Team $team
     * @param Role $role
     * @param Person $person
     * @param string $kind
     */
    public function __construct(Team $team, Role $role, Person $person, $kind)
    {
        $this->team = $team;
        $this->role = $role;
        $this->person = $person;
        $this->kind = $kind;
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

    /**
     * @return string
     */
    public function getKind()
    {
        return $this->kind;
    }
}
