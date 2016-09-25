<?php

namespace SportDe\CliClient\Api\Exception\ApiRequestError;

use SportDe\CliClient\Api\Exception\ApiRequestError;

class UnexpectedResponseStatusCode extends ApiRequestError
{
    /**
     * @var int
     */
    protected $statusCode;

    /**
     * @param string $actualResponseCode
     */
    public function __construct($actualResponseCode)
    {
        parent::__construct(sprintf('Unexpected API response status code: %d', $actualResponseCode));
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
