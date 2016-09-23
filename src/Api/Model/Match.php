<?php

namespace SportDe\CliClient\Api\Model;

class Match
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var \DateTimeImmutable
     */
    protected $startDateTime;

    /**
     * @param string $id
     * @param \DateTimeImmutable $startDateTime
     */
    public function __construct($id, \DateTimeImmutable $startDateTime)
    {
        $this->id = $id;
        $this->startDateTime = $startDateTime;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getStartDateTime()
    {
        return $this->startDateTime;
    }
}
