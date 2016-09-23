<?php

namespace SportDe\CliClient\Api\Exception\ApiRequestError;

use SportDe\CliClient\Api\Exception\ApiRequestError;

class UnexpectedResponseStatusCode extends ApiRequestError
{
    /**
     * @var int
     */
    protected $statusCode;

    public function __construct($actualResponseCode)
    {
        parent::__construct("Unexpected API response status code: $actualResponseCode");
        $this->statusCode = $actualResponseCode;
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }
}
