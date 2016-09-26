<?php

namespace Api\Factory;

use SportDe\CliClient\Api\Factory\DateTimeImmutableFactory;

class DateTimeImmutableFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \SportDe\CliClient\Api\Exception\WrongDateTimeFormat
     */
    public function testCreateException()
    {
        $factory = new DateTimeImmutableFactory();
        $factory->create('2016-09-20 15:00', 'Y-m-d H:i:s');
    }
}
