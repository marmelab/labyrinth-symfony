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

    public function createGame() : Game
    {
        $response = $this->client->request('GET', '/createGame');
        $jsonGame = json_decode($response->getBody()->getContents(), true);
        $game = new Game($jsonGame);
        return $game;
    }

    public function rotate(Game $game) : Game
    {
        $jsonGame = json_encode($game->getJsonGame());

        $response = $this->client->request('GET', '/rotate', ['body' => $jsonGame]);
        dump($jsonGame);
        dump($response->getBody()->getContents());
        die();

        $jsonGame = json_decode($response->getBody()->getContents(), true);

        $game = $game->setJsonGame($jsonGame);
        dump($jsonGame);

        dump($game);
        die();

        return $game;
    }
}
