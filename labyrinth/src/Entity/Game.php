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
    protected $remainingPathCard;
    protected $players;
    protected $scores;
    protected $currentIndexOfPathCardInsertionPosition;
    protected $currentPlayerIndex;
    protected $state;

    public function __construct(array $jsonGame)
    {
        $this->board = $jsonGame['board'];
        $this->remainingPathCard = $jsonGame['remainingPathCard'];
        $this->players = $jsonGame['players'];
        $this->scores = $jsonGame['scores'];
        $this->currentIndexOfPathCardInsertionPosition = $jsonGame['currentIndexOfPathCardInsertionPosition'];
        $this->currentPlayerIndex = $jsonGame['currentPlayerIndex'];
        $this->state = $jsonGame['state'];
    }

    public function getBoard(): array
    {
        return $this->board;
    }

    public function getRemainingPathCard(): array
    {
        return $this->remainingPathCard;
    }

    public function getPlayers(): array
    {
        return $this->players;
    }

    public function getScores(): array
    {
        return $this->scores;
    }

    public function getCurrentIndexOfPathCardInsertionPosition(): array
    {
        return $this->currentIndexOfPathCardInsertionPosition;
    }

    public function getCurrentPlayerIndex(): array
    {
        return $this->currentPlayerIndex;
    }

    public function getState(): array
    {
        return $this->state;
    }

}
