<?php

namespace App\Tests\Twig;

use App\Twig\GameExtension;

use PHPUnit\Framework\TestCase;

class GameExtensionTest extends TestCase
{
    public function testTileTypeToMatrix()
    {
        $gameExtension = new GameExtension();

        $corner = $gameExtension->tileTypeToMatrix("┗");
        $this->assertEquals(3, count($corner));
        foreach ($corner as $row) {
            $this->assertEquals(3, count($row));
        }

        $corner = $gameExtension->tileTypeToMatrix("┻");
        $this->assertEquals(3, count($corner));
        foreach ($corner as $row) {
            $this->assertEquals(3, count($row));
        }

        $corner = $gameExtension->tileTypeToMatrix("┃");
        $this->assertEquals(3, count($corner));
        foreach ($corner as $row) {
            $this->assertEquals(3, count($row));
        }
    }
}
