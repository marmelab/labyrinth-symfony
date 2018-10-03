<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Manager\GameManager;

class GameController extends AbstractController
{

    /**
     * @Route("/game")
     */
    public function index() // (GameManager $gameManager)
    {
        $gameManager = new GameManager();
        return $this->render('game.html.twig', [
            'game' => $gameManager->getGame()
         ]);
    }
}
