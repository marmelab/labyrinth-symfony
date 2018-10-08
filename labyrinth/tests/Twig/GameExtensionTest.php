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

    public function testFromBoardReferentialToDisplay()
    {
        $gameExtension = new GameExtension();
        // board referential: 'y' is going upward from -1 to 7
        // display referential : 'y' is going downward from 1 to 9
        $lowerLeftCorner = $gameExtension->fromBoardReferentialToDisplay([0,0]);
        $upperLeftCorner = $gameExtension->fromBoardReferentialToDisplay([0,6]);
        $lowerRightCorner = $gameExtension->fromBoardReferentialToDisplay([6,0]);
        $upperRightCorner = $gameExtension->fromBoardReferentialToDisplay([6,6]);
        $remainingPathCardPosition = $gameExtension->fromBoardReferentialToDisplay([1,-1]);

        $this->assertEquals(2, $lowerLeftCorner[0]);
        $this->assertEquals(8, $lowerLeftCorner[1]);

        $this->assertEquals(2, $upperLeftCorner[0]);
        $this->assertEquals(2, $upperLeftCorner[1]);

        $this->assertEquals(8, $lowerRightCorner[0]);
        $this->assertEquals(8, $lowerRightCorner[1]);

        $this->assertEquals(8, $upperRightCorner[0]);
        $this->assertEquals(2, $upperRightCorner[1]);

        $this->assertEquals(3, $remainingPathCardPosition[0]);
        $this->assertEquals(9, $remainingPathCardPosition[1]);
    }

}
