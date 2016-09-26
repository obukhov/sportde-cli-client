<?php

namespace Api\Factory;

use SportDe\CliClient\Api\Factory\MatchPlayerFactory;
use SportDe\CliClient\Api\Model\MatchPlayer;
use SportDe\CliClient\Api\Model\Person;
use SportDe\CliClient\Api\Model\Role;
use SportDe\CliClient\Api\Model\Team;

class MatchPlayerFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $matchPlayerFactory = new MatchPlayerFactory();

        $this->assertEquals(
            new MatchPlayer(
                new Team('1', 'FC Test'),
                new Role('3', 'Mittelfeld'),
                new Person('6', 'Dewey', 'Riley'),
                'lineup'
            ),
            $matchPlayerFactory->create(
                [
                    'team' => [
                        'id' => '1',
                        'name' => 'FC Test',
                    ],
                    'person' => [
                        'id' => '6',
                        'firstname' => 'Dewey',
                        'surname' => 'Riley'
                    ],
                    'team_person' => [
                        "id" => "1391680",
                        "shirtnumber" => "21",
                        "role" => [
                            "id" => "3",
                            "name" => "Mittelfeld",
                            "group" => "Athletes",
                            "order" => "3"
                        ]
                    ],
                    'kind' => 'lineup'
                ]
            )
        );
    }

    /**
     * @param array $jsonArray
     * @dataProvider provideTestCreateException
     * @expectedException \SportDe\CliClient\Api\Exception\ApiRequestError\WrongJsonStructure
     */
    public function testCreateException(array $jsonArray)
    {
        $matchPlayerFactory = new MatchPlayerFactory();
        $matchPlayerFactory->create($jsonArray);
    }

    public function provideTestCreateException()
    {
        return [
            'team id missing' => [
                'jsonArray' => [
                    'team' => [
                        'name' => 'FC Test',
                    ],
                    'person' => [
                        'id' => '6',
                        'firstname' => 'Dewey',
                        'surname' => 'Riley'
                    ],
                    'team_person' => [
                        "id" => "1391680",
                        "shirtnumber" => "21",
                        "role" => [
                            "id" => "3",
                            "name" => "Mittelfeld",
                            "group" => "Athletes",
                            "order" => "3"
                        ]
                    ],
                    'kind' => 'lineup'
                ]
            ],
            'team_person missing' => [
                'jsonArray' => [
                    'team' => [
                        'id' => '1',
                        'name' => 'FC Test',
                    ],
                    'person' => [
                        'id' => '6',
                        'firstname' => 'Dewey',
                        'surname' => 'Riley'
                    ],
                    'kind' => 'lineup'
                ]
            ],
        ];
    }
}
