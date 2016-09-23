<?php

namespace SportDe\CliClient\Api\Model;

class Person
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $firstName;

    /**
     * @var string
     */
    protected $surname;

    /**
     * Person constructor.
     * @param string $id
     * @param string $firstName
     * @param string $surname
     */
    public function __construct($id, $firstName, $surname)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->surname = $surname;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }
}
