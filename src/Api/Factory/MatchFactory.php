<?php

namespace SportDe\CliClient\Api\Factory;

use SportDe\CliClient\Api\Exception\ApiRequestError\WrongJsonStructure;
use SportDe\CliClient\Api\Model\Match;

class MatchFactory
{
    /**
     * @var DateTimeImmutableFactory
     */
    protected $dateTimeFactory;

    /**
     * @param DateTimeImmutableFactory $dateTimeFactory
     */
    public function __construct(DateTimeImmutableFactory $dateTimeFactory)
    {
        $this->dateTimeFactory = $dateTimeFactory;
    }

    /**
     * @param array $match
     * @return Match
     * @throws WrongJsonStructure
     */
    public function create(array $match)
    {
        if (!isset($match['id'], $match['match_date'], $match['match_time'])) {
            throw new WrongJsonStructure($match);
        }

        return new Match(
            $match['id'],
            $this->dateTimeFactory->create(sprintf('%s %s', $match['match_date'], $match['match_time']))
        );
    }
}
