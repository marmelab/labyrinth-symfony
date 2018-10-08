<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class GameExtension extends AbstractExtension
{
    public function getFunctions()
    {
        return array(
            new TwigFunction('tileTypeToMatrix', array($this, 'tileTypeToMatrix')),
            new TwigFunction('fromBoardReferentialToDisplay', array($this, 'fromBoardReferentialToDisplay')),
            new TwigFunction('fromDisplayReferentialToBoard', array($this, 'fromDisplayReferentialToBoard')),

        );
    }

    public function tileTypeToMatrix($tileType)
    {
        if ($tileType === "┗") {
            return [[1, 0, 1], [1, 0, 0], [1, 1, 1]];
        } elseif ($tileType === "┻") {
            return [[1, 0, 1], [0, 0, 0], [1, 1, 1]];
        } elseif ($tileType === "┃") {
            return [[1, 0, 1], [1, 0, 1], [1, 0, 1]];
        }
    }

    public function fromBoardReferentialToDisplay(array $position)
    {
        $x = $position[0];
        $y = $position[1];
        $newX = $x + 2; // +1 for remainingPath, +1 since display starts in 1
        $newY = 9 - $y - 1; // -1 for remainingPath
        return [$newX,$newY];
    }

    public function fromDisplayReferentialToBoard(array $position)
    {
        $x = $position[0];
        $y = $position[1];
        $newX = $x - 2;
        $newY = 9 - $y - 1;
        return [$newX,$newY];
    }
}
