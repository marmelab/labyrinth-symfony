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

    /**
     * @dataProvider boardDisplayProvider
     */
    public function testFromBoardReferentialToDisplay($boardPosition, $displayPosition)
    {
        $gameExtension = new GameExtension();
        $computedPosition = $gameExtension->fromBoardReferentialToDisplay($boardPosition);
        $this->assertEquals($displayPosition, $computedPosition);
    }

    /**
     * @dataProvider boardDisplayProvider
     */
    public function testFromDisplayReferentialToBoard($boardPosition, $displayPosition)
    {
        $gameExtension = new GameExtension();
        $computedPosition = $gameExtension->fromDisplayReferentialToBoard($displayPosition);
        $this->assertEquals($boardPosition, $computedPosition);
    }

    public function boardDisplayProvider()
    {
        // board referential: 'y' is going upward from -1 to 7
        // display referential : 'y' is going downward from 1 to 9
        return [
            'lowerLeftCorner' => [[0, 0], [2, 8]],
            'upperLeftCorner' => [[0, 6], [2, 2]],
            'lowerRightCorner' => [[6, 0], [8, 8]],
            'upperRightCorner' => [[6, 6], [8, 2]],
            'remainingPathCardPosition' => [[1, -1], [3, 9]],
        ];
    }


}
