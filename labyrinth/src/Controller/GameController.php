<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Game;

class GameController extends AbstractController
{
    private $game;

    /**
     * @Route("/game")
     */
    public function index()
    {
        $this->game = new Game();

        return $this->render('game.html.twig', [
             'game_name' => 'hello',
             'game_grid' => $this->game->getGrid()
         ]);
    }
}
