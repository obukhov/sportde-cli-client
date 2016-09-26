<?php

namespace SportDe\CliClient\Command\Exception;

class CommandException extends \Exception
{
    /**
     * @param string $message
     */
    public function __construct($message)
    {
        parent::__construct($message, 3);
    }
}
