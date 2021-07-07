<?php

namespace App\Utils;

class GameUtils
{
    public static function fromBoardReferentialToDisplay(array $position)
    {
        $x = $position[0];
        $y = $position[1];
        $newX = $x + 2; // +1 for remainingPath, +1 since display starts in 1
        $newY = 9 - $y - 1; // -1 for remainingPath
        return [$newX, $newY];
    }

    public static function fromDisplayReferentialToBoard(array $position)
    {
        $x = $position[0];
        $y = $position[1];
        $newX = $x - 2;
        $newY = 9 - $y - 1;
        return [$newX, $newY];
    }

    public static function convertJsonBoardPositionsIntoDisplayPositions(array $jsonPositions)
    {
        $displayPositions = array();
        foreach ($jsonPositions as $jsonPosition) {
            [$xDisplay, $yDisplay] = GameUtils::fromBoardReferentialToDisplay([$jsonPosition['x'], $jsonPosition['y']]);
            $displayPositions[] = [$xDisplay, $yDisplay];
        }
        return $displayPositions;
    }
}
