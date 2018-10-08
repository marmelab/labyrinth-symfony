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
        $game = $this->gameApi->createGame();
        return $this->render('game.html.twig', ['game' => $game]);
    }

    /**
     * @Route("/rotateRemainingPathCard/{x<\d+>}/{y<\d+>}", name="rotateRemainingPathCard")
     */
    public function rotateRemainingPathCard($x, $y)
    {
        // need to retrieve a game here: $this->gameRepository->findGameById($idGame);
        $game = $this->gameApi->rotateRemainingPathCard($this->gameApi->createGame(), $x, $y);
        return $this->render('game.html.twig', ['game' => $game]);
    }

    /**
     * @Route("/insertRemainingPathCard/{x<\d+>}/{y<\d+>}", name="insertRemainingPathCard")
     */
    public function insertRemainingPathCard($x, $y)
    {
        // need to retrieve a game here: $this->gameRepository->findGameById($idGame);
        $game = $this->gameApi->rotateRemainingPathCard($this->gameApi->createGame(), $x, $y);
        return $this->render('game.html.twig', ['game' => $game]);
    }
}
