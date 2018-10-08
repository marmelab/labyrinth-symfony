<?php

namespace App\Api;

use Symfony\Component\HttpFoundation\Response;
use App\Entity\Game;

class GameApiMock implements GameApiInterface
{
    public function createGame() : Game
    {
        $mockedResponse = file_get_contents(__DIR__ . '/../../data/board-example.json');
        $jsonGame = json_decode($mockedResponse, true);
        $game = new Game($jsonGame);
        return $game;
    }

    public function rotate(Game $game) : Game
    {
        return $game;
    }
}
