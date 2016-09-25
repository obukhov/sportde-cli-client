<?php

namespace SportDe\CliClient\Commands\LineUp\Model;

use SportDe\CliClient\Api\Model\Person;
use SportDe\CliClient\Api\Model\Role;

class RolePersons implements \IteratorAggregate
{
    /** @var Role */
    protected $role;

    /** @var  Person[] */
    protected $persons;

    /**
     * RoleLineUp constructor.
     * @param Role $role
     * @param Person[] $persons
     */
    public function __construct(Role $role, array $persons = [])
    {
        $this->role = $role;
        $this->persons = $persons;
    }

    /**
     * @param Person $person
     */
    public function addPerson(Person $person)
    {
        $this->persons[] = $person;
    }

    /**
     * @return Role
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->persons);
    }
}
