<?php

namespace Command\LineUp;

use DateTimeImmutable;
use SportDe\CliClient\Api\Model\Match;
use SportDe\CliClient\Api\Model\Person;
use SportDe\CliClient\Api\Model\Role;
use SportDe\CliClient\Api\Model\Team;
use SportDe\CliClient\Command\LineUp\LineUpFormatter;
use SportDe\CliClient\Command\LineUp\Model\LineUp;
use SportDe\CliClient\Command\LineUp\Model\RolePersons;
use SportDe\CliClient\Command\LineUp\Model\TeamLineUp;

class LineUpFormatterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param LineUp $lineUp
     * @param Match $match
     * @param string $expectedOutput
     *
     * @dataProvider providerTestFormat
     */
    public function testFormat(LineUp $lineUp, Match $match, $expectedOutput)
    {
        $formater = new LineUpFormatter($match, $lineUp);

        $this->assertEquals($expectedOutput, $formater->format());
    }

    public function providerTestFormat()
    {
        $team1 = new Team('1', 'FC Test');
        $team2 = new Team('2', 'FC Mock');

        $roleSturm = new Role('2', 'Sturm');
        $roleTorwart = new Role('3', 'Torwart');
        $roleAbwehr = new Role('4', 'Abwehr');

        return [
            'empty' => [
                'lineUp' => new LineUp(),
                'match' => new Match(1, new DateTimeImmutable('2016-09-19 11:30:00')),
                'expected' => 'Current/next match starts at 2016-09-19T11:30:00+00:00:' . PHP_EOL
                    . 'No line-up info for current or next match' . PHP_EOL
            ],
            'normal' => [
                'lineUp' => new LineUp(
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
                'match' => new Match(1, new DateTimeImmutable('2016-09-19 11:30:00')),
                'expected' => 'Current/next match starts at 2016-09-19T11:30:00+00:00:' . PHP_EOL
                    . PHP_EOL . 'FC Test' . PHP_EOL
                    . 'Torwart: John Doe' . PHP_EOL
                    . 'Abwehr: Dewey Riley, Billy Loomis' . PHP_EOL
                    . PHP_EOL . 'FC Mock' . PHP_EOL
                    . 'Torwart: Casey Becker' . PHP_EOL
                    . 'Abwehr: Gale Weathers' . PHP_EOL
                    . 'Sturm: Neil Prescott' . PHP_EOL
            ]
        ];
    }
}
