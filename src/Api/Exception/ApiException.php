<?php

namespace SportDe\CliClient\Api\Exception;

class ApiException extends \Exception
{
    public function __construct($message)
    {
        parent::__construct($message, 2);
    }
}
