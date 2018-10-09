<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Api\GameApiInterface;
use App\Repository\GameRepository;


class GameController extends AbstractController
{
    private $gameApi;
    private $gameRepository;

    public function __construct(GameApiInterface $gameApi, GameRepository $gameRepository)
    {
        $this->gameApi = $gameApi;
        $this->gameRepository = $gameRepository;
    }

    /**
     * @Route("/game")
     */
    public function index()
    {
        $game = $this->gameApi->createGame();
        $this->gameRepository->save($game);

        return $this->render('game.html.twig', ['game' => $game]);
    }

    /**
     * @Route("/rotateRemainingPathCard", name="rotateRemainingPathCard")
     */
    public function rotateRemainingPathCard()
    {
        // need to retrieve a game here: $this->gameRepository->findGameById($idGame);
        $game = $this->gameApi->rotateRemainingPathCard($this->gameApi->createGame());
        return $this->render('game.html.twig', ['game' => $game]);
    }

    /**
     * @Route("/insertRemainingPathCard/{x<\d+>}/{y<\d+>}", name="insertRemainingPathCard")
     */
    public function insertRemainingPathCard($x, $y)
    {
        // need to retrieve a game here: $this->gameRepository->findGameById($idGame);
        $game = $this->gameApi->rotateRemainingPathCard($this->gameApi->createGame()); // not the right function
        return $this->render('game.html.twig', ['game' => $game]);
    }
}
