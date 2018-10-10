<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GameRepository")
 * @ORM\Table
 */
class Game
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="json_array")
     */
    protected $board;

    /**
     * @ORM\Column(type="json_array")
     */
    protected $remainingPathCard;

    /**
     * @ORM\Column(type="json_array")
     */
    protected $players;

    /**
     * @ORM\Column(type="array")
     */
    protected $scores;

    /**
     * @ORM\Column(type="integer")
     */
    protected $currentIndexOfPathCardInsertionPosition;

    /**
     * @ORM\Column(type="integer")
     */
    protected $currentPlayerIndex;

    /**
     * @ORM\Column(type="integer")
     */
    protected $state;

    public function __construct(array $jsonGame)
    {
        $this->setJsonGame($jsonGame);
    }

    public function getId(): int
    {
        return $this->id;
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

    public function getCurrentIndexOfPathCardInsertionPosition(): int
    {
        return $this->currentIndexOfPathCardInsertionPosition;
    }

    public function getCurrentPlayerIndex(): int
    {
        return $this->currentPlayerIndex;
    }

    public function getState(): int
    {
        return $this->state;
    }

    public function setJsonGame($jsonGame)
    {
        $this->board = $jsonGame['board'];
        $this->remainingPathCard = $jsonGame['remainingPathCard'];
        $this->players = $jsonGame['players'];
        $this->scores = $jsonGame['scores'];
        $this->currentIndexOfPathCardInsertionPosition = $jsonGame['currentIndexOfPathCardInsertionPosition'];
        $this->currentPlayerIndex = $jsonGame['currentPlayerIndex'];
        $this->state = $jsonGame['state'];
    }

    public function toJson()
    {
        return [
            'board' => $this->board,
            'remainingPathCard' => $this->remainingPathCard,
            'players' => $this->players,
            'scores' => $this->scores,
            'currentIndexOfPathCardInsertionPosition' => $this->currentIndexOfPathCardInsertionPosition,
            'currentPlayerIndex' => $this->currentPlayerIndex,
            'state' => $this->state,
        ];
    }
}
