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
}
