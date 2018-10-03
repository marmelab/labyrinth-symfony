<?php

namespace App\Entity;

class Game
{
    public function getGrid() : array
    {
        $grid = array(
            array("A","B","C"),
            array("D","E","F"),
        );
        return $grid;
    }
}
