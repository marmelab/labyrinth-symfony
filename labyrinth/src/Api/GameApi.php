<?php

namespace App\Api;

use GuzzleHttp\Client;
use App\Entity\Game;
use App\Utils\GameUtils;

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
        $response = $this->client->request('POST', '/rotateRemainingPathCard', [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => $game->toJsonString()
        ]);

        $jsonGame = json_decode($response->getBody()->getContents(), true);
        $game->setJsonGame($jsonGame);
        return $game;
    }

    public function insertRemainingPathCard(Game $game, int $xDisplay, int $yDisplay): Game
    {
        [$x, $y] = GameUtils::fromDisplayReferentialToBoard([$xDisplay, $yDisplay]);
        $game->setRemainingPathCardAt($x, $y);

        $response = $this->client->request('POST', '/insertRemainingPathCard', [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => $game->toJsonString()
        ]);

        $jsonGame = json_decode($response->getBody()->getContents(), true);
        $game->setJsonGame($jsonGame);
        return $game;
    }

    public function movePlayerTo(Game $game, int $xDisplay, int $yDisplay): Game
    {
        $jsonGame = json_encode($game->toJson());

        [$x, $y] = GameUtils::fromDisplayReferentialToBoard([$xDisplay, $yDisplay]);
        $response = $this->client->request('POST', '/movePlayerTo/' . $x . '/' . $y, [
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'body' => $jsonGame
        ]);

        $jsonGame = json_decode($response->getBody()->getContents(), true);
        $game->setJsonGame($jsonGame);
        return $game;
    }
}
