<?php

namespace App\Tests\Utils;

use PHPUnit\Framework\TestCase;
use App\Utils\GameUtils;

class GameUtilsTest extends TestCase
{
    /**
     * @dataProvider boardDisplayProvider
     */
    public function testFromBoardReferentialToDisplay($boardPosition, $displayPosition)
    {
        $computedPosition = GameUtils::fromBoardReferentialToDisplay($boardPosition);
        $this->assertEquals($displayPosition, $computedPosition);
    }

    /**
     * @dataProvider boardDisplayProvider
     */
    public function testFromDisplayReferentialToBoard($boardPosition, $displayPosition)
    {

        $computedPosition = GameUtils::fromDisplayReferentialToBoard($displayPosition);
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
