<?php

namespace SportDe\CliClient\Commands\Exception;

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
