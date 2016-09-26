<?php

namespace Api\Factory;

use SportDe\CliClient\Api\Factory\DateTimeImmutableFactory;
use SportDe\CliClient\Api\Factory\MatchFactory;
use SportDe\CliClient\Api\Model\Match;

class MatchFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $factory = new MatchFactory(new DateTimeImmutableFactory());

        $this->assertEquals(
            new Match('8257857', new \DateTimeImmutable('2016-08-27T15:30:00')),
            $factory->create(
                [
                    'id' => "8257857",
                    'round_id' => "63882",
                    'round' => [
                        'id' => "63882",
                        'season_id' => "20812",
                        'name' => "Spieltag",
                        'current_matchday' => "5",
                        'round_order' => "0",
                        'table_mode' => [
                            'id' => "1",
                            'name' => "Fußball - Standard",
                            'explanation' => "Das klassische 3-Punkte System",
                            'show_draw' => "yes",
                            'show_percentage' => "no",
                            'show_points' => "yes",
                            'show_minuspoints' => "no"
                        ]
                    ],
                    'matchday' => "1",
                    'group_matchday' => "0",
                    'match_date' => "27.08.2016",
                    'match_time' => "15:30",
                    'finished' => "yes",
                    'live_status' => "full",
                ]
            )
        );
    }

    /**
     * @dataProvider provideTestCreateException
     * @expectedException \SportDe\CliClient\Api\Exception\ApiRequestError\WrongJsonStructure
     */
    public function testCreateException($jsonArray)
    {
        $factory = new MatchFactory(new DateTimeImmutableFactory());
        $factory->create($jsonArray);
    }

    /**
     * @return array
     */
    public function provideTestCreateException()
    {
        return [
            'id missing' => [
                'jsonArray' => [
                    'match_date' => '27.08.2016',
                    'match_time' => '15:30'
                ]
            ],
            'match_date missing' => [
                'jsonArray' => [
                    'id' => '123',
                    'match_time' => '15:30'
                ]
            ],
        ];
    }
}
