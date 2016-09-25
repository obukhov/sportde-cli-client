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
     * @param string $parsedJson
     */
    public function __construct($parsedJson)
    {
        $this->parsedJson = $parsedJson;
        parent::__construct(sprintf('Error parsing json response: %s', $parsedJson));
    }

    /**
     * @return string
     */
    public function getParsedJson()
    {
        return $this->parsedJson;
    }
}
