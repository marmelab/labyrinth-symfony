<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Api\GameApiInterface;

class GameController extends AbstractController
{
    private $gameApi;

    public function __construct(GameApiInterface $gameApi)
    {
        $this->gameApi = $gameApi;
    }

    /**
     * @Route("/game")
     */
    public function index()
    {
        return $this->render('game.html.twig', [
            'game' => $this->gameApi->getGame()
        ]);
    }
}
