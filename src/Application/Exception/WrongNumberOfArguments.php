<?php

namespace SportDe\CliClient\Application\Exception;

class WrongNumberOfArguments extends \Exception
{
    protected $numberOfArguments;

    /**
     * WrongNumberOfArguments constructor.
     * @param $numberOfArguments
     */
    public function __construct($numberOfArguments)
    {
        $this->numberOfArguments = $numberOfArguments;
        parent::__construct(sprintf('Wrong number of arguments: %s', $numberOfArguments));
    }
}
