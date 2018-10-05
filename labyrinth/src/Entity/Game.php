<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GameRepository")
 * @ORM\Table
 */
class Game
{
    protected $jsonGame;
    // protected $board;

    public function __construct(array $jsonGame)
    {
        $this->jsonGame = $jsonGame;
        // $this->board = $jsonGame['board'];
    }

    public function getJsonGame() : array
    {
        return $this->jsonGame;
    }

    public function setJsonGame(array $jsonGame) : Game
    {
        $this->jsonGame = $jsonGame;
        return $this;
    }

    public function getBoard() : array
    {
        // return $this->board;
        return $this->jsonGame['board'];
    }

    public function setBoard(array $jsonBoard) : Game
    {
        // $this->board = $jsonBoard;
        $this->jsonGame['board'] = $jsonBoard;
        return $this;
    }
}
