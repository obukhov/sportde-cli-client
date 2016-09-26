<?php

namespace SportDe\CliClient\Command\LineUp\Model;

use SportDe\CliClient\Api\Model\Person;
use SportDe\CliClient\Api\Model\Role;
use SportDe\CliClient\Api\Model\Team;

class TeamLineUp implements \IteratorAggregate
{
    /** @var  Team */
    protected $team;

    /** @var  RolePersons[] Role lineup indexed by role id */
    protected $rolesPersons;

    /**
     * @param Team $team
     * @param RolePersons[] $rolesLineup
     */
    public function __construct(Team $team, array $rolesLineup = [])
    {
        $this->team = $team;
        $this->rolesPersons = $rolesLineup;
    }

    public function addPersonToRole(Role $role, Person $person)
    {
        $roleId = $role->getId();
        if (!isset($this->rolesPersons[$roleId])) {
            $this->rolesPersons[$roleId] = new RolePersons($role);
        }

        $this->rolesPersons[$roleId]->addPerson($person);
    }

    /**
     * @return Team
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->rolesPersons);
    }
}
