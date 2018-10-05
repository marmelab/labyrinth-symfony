<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GameRepository")
 * @ORM\Table
 */
class Game
{
    protected $board;

    public function __construct(array $board)
    {
        $this->board = $board;
    }

    public function getBoard() : array
    {
        return $this->board;
    }

    public function setBoard(array $board) : Game
    {
        $this->board = $board;
        return $this;
    }
}
