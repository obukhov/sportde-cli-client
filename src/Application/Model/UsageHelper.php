<?php

namespace SportDe\CliClient\Application\Model;

class UsageHelper implements ResultFormatter
{
    /**
     * @var \Exception
     */
    protected $exception;

    /**
     * @param \Exception $exception
     */
    public function __construct(\Exception $exception)
    {
        $this->exception = $exception;
    }

    /**
     * @return string
     */
    public function format()
    {
        $outputFormatted = sprintf('Error: %s' . PHP_EOL, $this->exception->getMessage());
        $outputFormatted .= 'Usage: php get.php <seasonId> <teamId> [<currentDate>]'. PHP_EOL . PHP_EOL;

        return $outputFormatted;
    }
}
