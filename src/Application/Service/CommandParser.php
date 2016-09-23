<?php

namespace SportDe\CliClient\Application\Service;

use SportDe\CliClient\Application\Exception\WrongNumberOfArguments;
use SportDe\CliClient\Application\Model\GetLineUpCommand;

class CommandParser
{

    public function parse(array $arguments)
    {
        if (count($arguments) != 3) {
            throw new WrongNumberOfArguments(count($arguments) - 1);
        }

        return new GetLineUpCommand($arguments[1], $arguments[2]);
    }
}
