<?php

namespace SportDe\CliClient\Application\Model;

interface ResultFormatter
{
    /**
     * @return string
     */
    public function format();
}
