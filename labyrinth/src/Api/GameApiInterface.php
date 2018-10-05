<?php

namespace App\Api;

use App\Entity\Game;

interface GameApiInterface
{
    public function createGame() : Game;
    public function rotate(Game $game) : Game;
}
