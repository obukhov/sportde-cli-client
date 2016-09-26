<?php

use SportDe\CliClient\Api\ApiClient;
use SportDe\CliClient\Api\Model\Match;
use SportDe\CliClient\Api\Model\MatchPlayer;
use SportDe\CliClient\Api\Model\Person;
use SportDe\CliClient\Api\Model\Role;
use SportDe\CliClient\Api\Model\Team;
use SportDe\CliClient\Command\LineUp\LineUpService;
use SportDe\CliClient\Command\LineUp\Model\LineUp;
use SportDe\CliClient\Command\LineUp\Model\RolePersons;
use SportDe\CliClient\Command\LineUp\Model\TeamLineUp;

class LineUpServiceTest extends PHPUnit_Framework_TestCase
{
    /**
     * @param string $teamId
     * @param string $seasonId
     * @param DateTimeImmutable $currentTime
     * @param Match[] $matches
     * @param Match $expectedMatch
     *
     * @dataProvider providerTestCurrentMatch
     */
    public function testGetCurrentMatch($teamId, $seasonId, $currentTime, $matches, $expectedMatch)
    {
        /** @var ApiClient|\Prophecy\Prophecy\ObjectProphecy $apiClient */
        $apiClient = $this->prophesize(ApiClient::class);
        $apiClient->getMatches($teamId, $seasonId)->willReturn($matches);

        $service = new LineUpService($apiClient->reveal());
        $currentMatch = $service->getCurrentMatch($teamId, $seasonId, $currentTime);

        $this->assertEquals($expectedMatch, $currentMatch);
    }

    public function providerTestCurrentMatch()
    {
        return [
            'current match' => [
                'teamId' => '1',
                'seasonId' => '100200',
                'currentTime' => new DateTimeImmutable('2016-09-20 12:30:00'),
                'matches' => [
                    new Match(1, new DateTimeImmutable('2016-09-19 11:30:00')),
                    new Match(2, new DateTimeImmutable('2016-09-20 11:30:00')),
                    new Match(3, new DateTimeImmutable('2016-09-20 15:30:00')),
                ],
                'expectedMatch' => new Match(2, new DateTimeImmutable('2016-09-20 11:30:00'))
            ],
            'next match' => [
                'teamId' => '1',
                'seasonId' => '100200',
                'currentTime' => new DateTimeImmutable('2016-09-20 12:30:00'),
                'matches' => [
                    new Match(2, new DateTimeImmutable('2016-09-20 16:30:00')),
                ],
                'expectedMatch' => new Match(2, new DateTimeImmutable('2016-09-20 16:30:00'))
            ],
        ];
    }

    /**
     * @expectedException \SportDe\CliClient\Command\LineUp\Exception\NoCurrentMatch
     */
    public function testGetCurrentMatchException()
    {
        /** @var ApiClient|\Prophecy\Prophecy\ObjectProphecy $apiClient */
        $apiClient = $this->prophesize(ApiClient::class);
        $apiClient->getMatches('9', '20812')->willReturn(
            [
                new Match(1, new DateTimeImmutable('2016-09-19 11:30:00')),
                new Match(2, new DateTimeImmutable('2016-09-20 11:30:00')),
                new Match(3, new DateTimeImmutable('2016-09-20 15:30:00')),
            ]
        );

        $service = new LineUpService($apiClient->reveal());
        $service->getCurrentMatch('9', '20812', new DateTimeImmutable('2016-09-20 20:30:00'));
    }

    public function testGetLineUpForCurrentMatch()
    {
        /** @var ApiClient|\Prophecy\Prophecy\ObjectProphecy $apiClient */
        $apiClient = $this->prophesize(ApiClient::class);

        $team1 = new Team('1', 'FC Test');
        $team2 = new Team('2', 'FC Mock');

        $roleSturm = new Role('2', 'Sturm');
        $roleTorwart = new Role('3', 'Torwart');
        $roleAbwehr = new Role('4', 'Abwehr');

        $apiClient->getMatchPlayers('23')->willReturn(
            [
                new MatchPlayer($team1, $roleTorwart, new Person('5', 'John', 'Doe'), 'lineup'),
                new MatchPlayer($team1, $roleAbwehr, new Person('6', 'Dewey', 'Riley'), 'lineup'),
                new MatchPlayer($team1, $roleAbwehr, new Person('7', 'Billy', 'Loomis'), 'lineup'),
                new MatchPlayer($team1, $roleTorwart, new Person('8', 'Cotton', 'Weary'), 'bench'),

                new MatchPlayer($team2, $roleTorwart, new Person('9', 'Casey', 'Becker'), 'lineup'),
                new MatchPlayer($team2, $roleAbwehr, new Person('10', 'Gale', 'Weathers'), 'lineup'),
                new MatchPlayer($team2, $roleAbwehr, new Person('11', 'Maureen', 'Prescott'), 'bench'),
                new MatchPlayer($team2, $roleSturm, new Person('12', 'Neil', 'Prescott'), 'lineup'),
            ]
        );

        $service = new LineUpService($apiClient->reveal());
        $lineUp = $service->getLineUpForCurrentMatch(new Match('23', new DateTimeImmutable('2016-09-20 15:30:00')));

        $this->assertEquals(
            new LineUp(
                [
                    '1' => new TeamLineUp(
                        $team1,
                        [
                            '3' => new RolePersons($roleTorwart, [new Person('5', 'John', 'Doe')]),
                            '4' => new RolePersons(
                                $roleAbwehr,
                                [
                                    new Person('6', 'Dewey', 'Riley'),
                                    new Person('7', 'Billy', 'Loomis')
                                ]
                            ),
                        ]
                    ),
                    '2' => new TeamLineUp(
                        $team2,
                        [
                            '3' => new RolePersons($roleTorwart, [new Person('9', 'Casey', 'Becker')]),
                            '4' => new RolePersons($roleAbwehr, [new Person('10', 'Gale', 'Weathers')]),
                            '2' => new RolePersons($roleSturm, [new Person('12', 'Neil', 'Prescott')]),
                        ]
                    )
                ]
            ),
            $lineUp
        );

    }
}
