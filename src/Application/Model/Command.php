<?php

namespace SportDe\CliClient\Application\Model;

interface Command
{
    /**
     * @return string
     */
    public function getCommandName();
}
