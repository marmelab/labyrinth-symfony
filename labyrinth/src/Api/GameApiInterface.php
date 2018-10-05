<?php

namespace App\Api;

use App\Entity\Game;

interface GameApiInterface
{
    public function getGame() : Game;
}
