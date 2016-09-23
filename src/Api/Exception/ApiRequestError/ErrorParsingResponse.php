<?php

namespace SportDe\CliClient\Api\Exception\ApiRequestError;

use SportDe\CliClient\Api\Exception\ApiRequestError;

class ErrorParsingResponse extends ApiRequestError
{
    /**
     * @var string
     */
    protected $parsedJson;

    /**
     * ErrorParsingResponse constructor.
     * @param string $parsedJson
     */
    public function __construct($parsedJson)
    {
        $this->parsedJson = $parsedJson;
        parent::__construct("Error parsing json response: $parsedJson");
    }

    /**
     * @return string
     */
    public function getParsedJson()
    {
        return $this->parsedJson;
    }
}
