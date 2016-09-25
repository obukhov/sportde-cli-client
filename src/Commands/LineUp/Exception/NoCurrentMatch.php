<?php

namespace SportDe\CliClient\Commands\LineUp\Exception;

use SportDe\CliClient\Commands\Exception\CommandException;

class NoCurrentMatch extends CommandException
{
    /**
     * @param string $message
     */
    public function __construct($message = '')
    {
        parent::__construct(sprintf('No current match found %s', $message));
    }
}
