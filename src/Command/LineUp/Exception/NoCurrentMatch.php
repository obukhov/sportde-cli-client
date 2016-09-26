<?php

namespace SportDe\CliClient\Command\LineUp\Exception;

use SportDe\CliClient\Command\Exception\CommandException;

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
