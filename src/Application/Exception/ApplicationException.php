<?php

namespace SportDe\CliClient\Application\Exception;

class ApplicationException extends \Exception
{
    /**
     * @param string $message
     */
    public function __construct($message)
    {
        parent::__construct($message, 1);
    }
}
