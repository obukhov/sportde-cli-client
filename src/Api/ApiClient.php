<?php

namespace SportDe\CliClient\Api;

use SportDe\CliClient\Api\Factory\MatchPlayerFactory;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use SportDe\CliClient\Api\Exception\ApiRequestError\ErrorParsingResponse;
use SportDe\CliClient\Api\Exception\ApiRequestError\UnexpectedResponseStatusCode;
use SportDe\CliClient\Api\Exception\MatchesNotFound;
use SportDe\CliClient\Api\Factory\MatchFactory;
use SportDe\CliClient\Api\Model\Match;
use SportDe\CliClient\Api\Model\MatchPlayer;

class ApiClient
{
    const MATCHES_URI_TEMPLATE = 'https://api.sport1.de/api/sports/matches-by-season-team/co/se%s/te%s';
    const MATCH_PLAYERS_URI_TEMPLATE = 'https://api.sport1.de/api/sports/match-event/ma%s';

    /**
     * @var Client
     */
    protected $guzzleClient;

    /**
     * @var MatchFactory
     */
    protected $matchFactory;

    /**
     * @var MatchPlayerFactory
     */
    protected $matchPlayerFactory;

    /**
     * @param Client $guzzleClient
     * @param MatchFactory $matchFactory
     * @param MatchPlayerFactory $matchPlayerFactory
     */
    public function __construct(
        Client $guzzleClient,
        MatchFactory $matchFactory,
        MatchPlayerFactory $matchPlayerFactory
    ) {
        $this->guzzleClient = $guzzleClient;
        $this->matchFactory = $matchFactory;
        $this->matchPlayerFactory = $matchPlayerFactory;
    }

    /**
     * @param string $teamId
     * @param string $seasonId
     *
     * @throws ErrorParsingResponse
     * @throws MatchesNotFound
     * @throws UnexpectedResponseStatusCode
     *
     * @return \Generator|Match[]
     */
    public function getMatches($teamId, $seasonId)
    {
        $response = $this->guzzleClient->request('GET', sprintf(self::MATCHES_URI_TEMPLATE, $seasonId, $teamId));
        $responseArray = $this->decodeResponse($response);

        if (!isset($responseArray['match'])) {
            throw new MatchesNotFound('Matches for provided criteria not found');
        }

        foreach ($responseArray['match'] as $match) {
            yield $this->matchFactory->create($match);
        }
    }

    /**
     * @param $matchId
     * @return \Generator|MatchPlayer[]
     * @throws MatchesNotFound
     */
    public function getMatchPlayers($matchId)
    {
        $response = $this->guzzleClient->request('GET', sprintf(self::MATCH_PLAYERS_URI_TEMPLATE, $matchId));
        $responseArray = $this->decodeResponse($response);

        if (empty($responseArray)) {
            throw new MatchesNotFound('Matches for provided criteria not found');
        }

        foreach ($responseArray as $matchPlayer) {
            try {
                yield $this->matchPlayerFactory->create($matchPlayer);
            } catch (\Exception $e) {
                // skip non-properly formatted elements
            }
        }
    }

    /**
     * @param ResponseInterface $response
     * @return array
     * @throws ErrorParsingResponse
     * @throws UnexpectedResponseStatusCode
     */
    protected function decodeResponse(ResponseInterface $response)
    {
        if (200 != $response->getStatusCode()) {
            throw new UnexpectedResponseStatusCode($response->getStatusCode());
        }

        try {
            $responseArray = \GuzzleHttp\json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            throw new ErrorParsingResponse($response->getBody()->getContents());
        }

        return $responseArray;
    }
}
