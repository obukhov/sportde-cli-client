<?php

namespace SportDe\CliClient\Application\Model;

interface Processor
{
    /**
     * @param Command $command
     * @return ResultFormatter
     */
    public function process(Command $command);
}
