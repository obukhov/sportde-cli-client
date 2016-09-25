<?php

namespace SportDe\CliClient\Application\Exception;

class WrongNumberOfArguments extends \Exception
{
    /**
     * @var int
     */
    protected $numberOfArguments;

    /**
     * @param int $numberOfArguments
     */
    public function __construct($numberOfArguments)
    {
        $this->numberOfArguments = $numberOfArguments;
        parent::__construct(sprintf('Wrong number of arguments: %d', $numberOfArguments));
    }

    /**
     * @return int
     */
    public function getNumberOfArguments()
    {
        return $this->numberOfArguments;
    }
}
