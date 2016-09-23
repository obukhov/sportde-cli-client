<?php

namespace SportDe\CliClient\Api\Factory;

use SportDe\CliClient\Api\Exception\ApiRequestError\WrongJsonStructure;
use SportDe\CliClient\Api\Model\MatchPlayer;
use SportDe\CliClient\Api\Model\Person;
use SportDe\CliClient\Api\Model\Role;
use SportDe\CliClient\Api\Model\Team;

class MatchPlayerFactory
{
    /**
     * @param array $matchPlayer
     * @return MatchPlayer
     * @throws WrongJsonStructure
     */
    public function create(array $matchPlayer)
    {
        $isArrayValid = isset(
            $matchPlayer['team']['id'],
            $matchPlayer['team']['name'],
            $matchPlayer['team_person']['role']['id'],
            $matchPlayer['team_person']['role']['name'],
            $matchPlayer['person']['id'],
            $matchPlayer['person']['firstname'],
            $matchPlayer['person']['surname']
        );

        if (!$isArrayValid) {
            throw new WrongJsonStructure($matchPlayer);
        }
        return new MatchPlayer(
            new Team($matchPlayer['team']['id'], $matchPlayer['team']['name']),
            new Role($matchPlayer['team_person']['role']['id'], $matchPlayer['team_person']['role']['name']),
            new Person(
                $matchPlayer['person']['id'],
                $matchPlayer['person']['firstname'],
                $matchPlayer['person']['surname']
            )
        );
    }
}
