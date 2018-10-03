<?php
namespace App\Tests\Manager;

use App\Manager\GameManager;
use App\Entity\Game;

use PHPUnit\Framework\TestCase;

class gameManagerManagerTest extends TestCase
{
    public function testGetGame()
    {
        $gameManager = new GameManager();
        $game = $gameManager->getGame();
        $numberOfRows = count($game->getBoard());
        $this->assertEquals(7, $numberOfRows);
        foreach ($game->getBoard() as $row) {
            $this->assertEquals(7, count($row));
        }
    }
}
