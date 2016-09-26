<?php

namespace SportDe\CliClient\Api\Factory;

use SportDe\CliClient\Api\Exception\WrongDateTimeFormat;

class DateTimeImmutableFactory
{
    /**
     * @param string $dateTimeFormatted
     * @param string $format
     * @return \DateTimeImmutable
     * @throws WrongDateTimeFormat
     */
    public function create($dateTimeFormatted, $format = 'd.m.Y H:i')
    {
        $dateTime = \DateTimeImmutable::createFromFormat($format, $dateTimeFormatted, new \DateTimeZone('UTC'));

        if (false === $dateTime) {
            throw new WrongDateTimeFormat($dateTimeFormatted);
        }

        return $dateTime;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function createCurrent()
    {
        return new \DateTimeImmutable('now', new \DateTimeZone('UTC'));
    }
}
