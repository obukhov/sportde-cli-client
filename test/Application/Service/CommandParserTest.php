<?php

namespace Application\Service;

use SportDe\CliClient\Api\Exception\WrongDateTimeFormat;
use SportDe\CliClient\Api\Factory\DateTimeImmutableFactory;
use SportDe\CliClient\Application\Exception\WrongNumberOfArguments;
use SportDe\CliClient\Application\Model\Command;
use SportDe\CliClient\Application\Service\CommandParser;
use SportDe\CliClient\Command\LineUp\GetLineUpCommand;

class CommandParserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param array $args
     * @param Command $expectedCommand
     *
     * @param bool $callCurrent
     * @dataProvider provideTestParse
     */
    public function testParse(array $args, Command $expectedCommand, $callCurrent = false)
    {

        if ($callCurrent) {
            /** @var \Prophecy\Prophecy\ObjectProphecy $dateTimeFactory */
            $dateTimeFactoryMock = $this->prophesize(DateTimeImmutableFactory::class);
            $dateTimeFactoryMock->createCurrent()->willReturn(new \DateTimeImmutable('2016-09-25T00:00:00'));
            $dateTimeFactory = $dateTimeFactoryMock->reveal();
        } else {
            $dateTimeFactory = new DateTimeImmutableFactory();
        }

        $parser = new CommandParser($dateTimeFactory);
        $command = $parser->parse($args);

        $this->assertEquals($expectedCommand, $command);
    }

    /**
     * @return array
     */
    public function provideTestParse()
    {
        return [
            [
                'args' => ['get.php', '8257857', '9'],
                'expectedCommand' => new GetLineUpCommand(
                    '8257857', '9', new \DateTimeImmutable('2016-09-25T00:00:00')
                ),
                'callCurrent' => true
            ],
            [
                'args' => ['get.php', '8257857', '9', '2016-10-01T00:00:00'],
                'expectedCommand' => new GetLineUpCommand('8257857', '9', new \DateTimeImmutable('2016-10-01T00:00:00'))
            ],
        ];
    }

    /**
     * @param array $args
     * @param string $expectedException
     * @dataProvider provideTestParseException
     */
    public function testParseException(array $args, $expectedException)
    {
        $this->expectException($expectedException);
        $parser = new CommandParser(new DateTimeImmutableFactory());

        $parser->parse($args);
    }

    /**
     * @return array
     */
    public function provideTestParseException()
    {
        return [
            [
                'args' => ['get.php', '9'],
                'exception' => WrongNumberOfArguments::class,
            ],
            [
                'args' => ['get.php', '8257857', '9', '2016-09-25T00:00:00', 'debug'],
                'exception' => WrongNumberOfArguments::class,
            ],
            [
                'args' => ['get.php', '8257857', '9', '2016-09-25 00:00:00'],
                'exception' => WrongDateTimeFormat::class,
            ],
        ];
    }
}
