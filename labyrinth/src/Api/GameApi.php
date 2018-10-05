<?php

namespace App\Api;

use Symfony\Component\HttpFoundation\Response;
use GuzzleHttp\Client;
use App\Entity\Game;

class GameApi implements GameApiInterface
{
    private $client;

    public function __construct(Client $gameApiClient)
    {
        $this->client = $gameApiClient;
    }

    public function getGame() : Game
    {
        $response = $this->client->request('GET', '/game');
        $jsonGame = json_decode($response->getBody()->getContents(), true); // true to get an array

        $game = new Game($jsonGame['board']);
        return $game;
    }
}
