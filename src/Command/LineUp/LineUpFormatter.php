<?php

namespace SportDe\CliClient\Command\LineUp;

use SportDe\CliClient\Api\Model\Match;
use SportDe\CliClient\Api\Model\Person;
use SportDe\CliClient\Application\Model\ResultFormatter;
use SportDe\CliClient\Command\LineUp\Model\LineUp;
use SportDe\CliClient\Command\LineUp\Model\RolePersons;
use SportDe\CliClient\Command\LineUp\Model\TeamLineUp;

class LineUpFormatter implements ResultFormatter
{
    /**
     * @var LineUp
     */
    protected $lineUp;

    /**
     * @var Match
     */
    private $resultMatch;

    /**
     * @param Match $resultMatch
     * @param LineUp $lineUp
     */
    public function __construct(Match $resultMatch, LineUp $lineUp)
    {
        $this->lineUp = $lineUp;
        $this->resultMatch = $resultMatch;
    }

    /**
     * @return string
     */
    public function format()
    {
        $output = '';
        /** @var TeamLineUp $teamLineUp */
        foreach ($this->lineUp as $teamLineUp) {
            $output .= PHP_EOL . $teamLineUp->getTeam()->getName() . PHP_EOL;

            /** @var RolePersons $roleLineUp */
            foreach ($teamLineUp as $roleLineUp) {
                $names = [];
                /** @var Person $person */
                foreach ($roleLineUp as $person) {
                    $names[] = $person->getFirstName() . ' ' . $person->getSurname();
                }

                $output .= $roleLineUp->getRole()->getName() . ': ' . implode(', ', $names) . PHP_EOL;
            }
        }

        if ('' === $output) {
            $output = 'No line-up info for current or next match'. PHP_EOL;
        }

        $matchHeader = sprintf(
            'Current/next match starts at %s:' . PHP_EOL,
            $this->resultMatch->getStartDateTime()->format('c')
        );

        $output = $matchHeader . $output;

        return $output;
    }
}
