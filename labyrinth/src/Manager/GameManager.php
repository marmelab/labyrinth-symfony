<?php

namespace App\Manager;

use Symfony\Component\HttpFoundation\Response;
use GuzzleHttp\Client;
use App\Entity\Game;

class GameManager
{
    private $httpClient;

    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function getGame() : Game
    {
        $response = $this->httpClient->request('GET', '/game');
        $jsonGame = json_decode($response->getBody()->getContents(), true); // true to get an array

        $game = new Game();
        $game->setBoard($jsonGame['board']);
        return $game;
    }
}
