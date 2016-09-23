<?php

namespace SportDe\CliClient\Api\Exception;

class WrongDateTimeFormat extends \Exception
{
    /**
     * @var string
     */
    protected $parsedString;

    /**
     * @param string $parsedString
     */
    public function __construct($parsedString)
    {
        parent::__construct("Error parsing date time string: $parsedString");
        $this->parsedString = $parsedString;
    }

    /**
     * @return string
     */
    public function getParsedString()
    {
        return $this->parsedString;
    }
}
