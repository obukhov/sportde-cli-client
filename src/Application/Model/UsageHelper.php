<?php

namespace SportDe\CliClient\Application\Model;

class UsageHelper implements ResultFormatter
{
    /**
     * @var \Exception
     */
    protected $exception;

    /**
     * @var string
     */
    private $scriptName;

    /**
     * @param \Exception $exception
     * @param string $scriptName
     */
    public function __construct(\Exception $exception, $scriptName)
    {
        $this->exception = $exception;
        $this->scriptName = $scriptName;
    }

    /**
     * @return string
     */
    public function format()
    {
        $outputFormatted = sprintf('Error: %s' . PHP_EOL, $this->exception->getMessage());
        $outputFormatted .= 'Usage: php ' . $this->scriptName
            . ' <seasonId> <teamId> [<currentDate Y-m-dTH:i:s>]' . PHP_EOL . PHP_EOL;

        return $outputFormatted;
    }
}
