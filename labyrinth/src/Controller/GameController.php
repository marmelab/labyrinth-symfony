<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Manager\GameManager;

class GameController extends AbstractController
{
    public function __construct(GameManager $gameManager)
    {
        $this->gameManager = $gameManager;
    }

    /**
     * @Route("/game")
     */
    public function index()
    {
        return $this->render('game.html.twig', [
            'game' => $this->gameManager->getGame()
        ]);
    }
}
