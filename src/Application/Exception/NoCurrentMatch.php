<?php

namespace SportDe\CliClient\Application\Exception;

class NoCurrentMatch extends \Exception
{
    /**
     * @param string $message
     * @param int $code
     * @param \Exception|null $previous
     */
    public function __construct($message = "", $code = 0, \Exception $previous = null)
    {
        parent::__construct("No current match " . $message, $code, $previous);
    }
}
