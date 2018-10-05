<?php

namespace App\Api;

use Symfony\Component\HttpFoundation\Response;
use App\Entity\Game;

class GameApiMock implements GameApiInterface
{
    public function getGame() : Game
    {
        $mockedResponse = file_get_contents(__DIR__ . '/../../data/board-example.json');
        $jsonGame = json_decode($mockedResponse, true); // true to get an array
        $game = new Game($jsonGame['board']);
        return $game;
    }
}
