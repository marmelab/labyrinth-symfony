<?php

namespace App\Api;

use GuzzleHttp\Client;
use App\Entity\Game;

class GameApi implements GameApiInterface
{
    private $client;

    public function __construct(Client $gameApiClient)
    {
        $this->client = $gameApiClient;
    }

    public function createGame(): Game
    {
        $response = $this->client->request('GET', '/createGame');
        $jsonGame = json_decode($response->getBody()->getContents(), true);
        $game = new Game($jsonGame);
        return $game;
    }

    public function rotateRemainingPathCard(Game $game): Game
    {
        $jsonGame = json_encode($game->toJson());

        $response = $this->client->request('POST', '/rotate', [
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'body' => $jsonGame]);

        $jsonGame = json_decode($response->getBody()->getContents(), true);
        $game->setJsonGame($jsonGame);
        return $game;
    }
}
