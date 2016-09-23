<?php

namespace SportDe\CliClient\Application\Service;

class UsageHelper
{
    /**
     * @param \Exception $exception
     * @return string
     */
    public function format(\Exception $exception = null)
    {
        $outputFormatted = '';

        if (null != $exception) {
            $outputFormatted .= sprintf('Error: %s' . PHP_EOL, $exception->getMessage());
        }

        $outputFormatted .= 'Usage: php get.php <seasonId> <teamId>'. PHP_EOL . PHP_EOL;

        return $outputFormatted;
    }
}
