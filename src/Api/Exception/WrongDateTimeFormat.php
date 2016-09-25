<?php

namespace SportDe\CliClient\Api\Exception;

class WrongDateTimeFormat extends ApiException
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
        parent::__construct(sprintf('Error parsing date time string: %s', $parsedString));
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
