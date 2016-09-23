<?php

namespace SportDe\CliClient\Api\Exception\ApiRequestError;

class WrongJsonStructure extends \Exception
{
    protected $wrongJson;

    /**
     * @param array $wrongJson
     */
    public function __construct(array $wrongJson)
    {
        $this->wrongJson = $wrongJson;
        parent::__construct(sprintf("Wrong json structure: %s", json_encode($wrongJson)));
    }
}
