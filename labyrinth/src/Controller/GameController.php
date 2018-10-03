<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GameController extends AbstractController
{
    /**
     * @Route("/game")
     */
    public function index()
    {
        return $this->render('game.html.twig');
    }

    public function getGrid() : array
    {
        $grid = array(
            array("A","B","C"),
            array("D","E","F"),
        );
        return $grid;
    }
}
