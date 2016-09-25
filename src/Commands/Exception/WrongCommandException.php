<?php

namespace SportDe\CliClient\Commands\Exception;

class WrongCommandException extends CommandException
{
    /**
     * @param string $message
     */
    public function __construct($message = '')
    {
        parent::__construct('Wrong command provided to process ' . $message);
    }
}
