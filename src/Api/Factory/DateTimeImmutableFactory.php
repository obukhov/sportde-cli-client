<?php

namespace SportDe\CliClient\Api\Factory;

use SportDe\CliClient\Api\Exception\WrongDateTimeFormat;

class DateTimeImmutableFactory
{
    /**
     * @param string $dateTimeFormatted
     * @return \DateTimeImmutable
     * @throws WrongDateTimeFormat
     */
    public function create($dateTimeFormatted)
    {
        $dateTime =  \DateTimeImmutable::createFromFormat("d.m.Y H:i", $dateTimeFormatted);

        if (false === $dateTime) {
            throw new WrongDateTimeFormat($dateTimeFormatted);
        }

        return $dateTime;
    }
}
