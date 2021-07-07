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

    public function rotateRemainingPathCard(Game $game) : Game
    {
        return $game;
    }

    public function insertRemainingPathCard(Game $game, int $xDisplay, int $yDisplay): Game
    {
        return $game;
    }

    public function movePlayerTo(Game $game, int $xDisplay, int $yDisplay): Game
    {
        return $game;
    }

}
