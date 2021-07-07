<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Api\GameApiInterface;
use App\Repository\GameRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

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
     * @Route("/createGame", name="createGame")
     */
    public function createGame(SessionInterface $session)
    {
        $game = $this->gameApi->createGame();

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($game);
        $entityManager->flush();
        $session->set('playerIndex', 0);
        $response = $this->redirectToRoute('game', array('idGame' => $game->getId()));

        return $response;
    }

    /**
     * @Route("/game/{idGame<\d+>}", name="game")
     */
    public function game(int $idGame, SessionInterface $session)
    {
        $game = $this->gameRepository->findGameById($idGame);
        return $this->render('game.html.twig',
            ['game' => $game,
             'playerIndex' => $session->get('playerIndex')
            ]);
    }

    /**
     * @Route("/join/{idGame<\d+>}", name="join")
     */
    public function join(int $idGame, SessionInterface $session)
    {
        $session->set('playerIndex', 1);
        $response = $this->redirectToRoute('game', array('idGame' => $idGame));
        return $response;
    }

    /**
     * @Route("/game/{idGame<\d+>}/rotateRemainingPathCard", name="rotateRemainingPathCard")
     */
    public function rotateRemainingPathCard(int $idGame)
    {
        $game = $this->gameRepository->findGameById($idGame);
        $updatedGame = $this->gameApi->rotateRemainingPathCard($game);
        return $this->flushAndRedirect($idGame, $updatedGame);
    }

    /**
     * @Route("/game/{idGame<\d+>}/insertRemainingPathCard/{x<\d+>}/{y<\d+>}", name="insertRemainingPathCard")
     */
    public function insertRemainingPathCard(int $idGame, int $x, int $y)
    {
        $game = $this->gameRepository->findGameById($idGame);
        $updatedGame = $this->gameApi->insertRemainingPathCard($game, $x, $y);
        return $this->flushAndRedirect($idGame, $updatedGame);
    }

    /**
     * @Route("/game/{idGame<\d+>}/movePlayerTo/{x<\d+>}/{y<\d+>}", name="movePlayerTo")
     */
    public function movePlayerTo(int $idGame, int $x, int $y)
    {
        $game = $this->gameRepository->findGameById($idGame);
        $updatedGame = $this->gameApi->movePlayerTo($game, $x, $y);
        return $this->flushAndRedirect($idGame, $updatedGame);
    }

    private function flushAndRedirect(int $idGame, $updatedGame)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($updatedGame);
        $entityManager->flush();

        $response = $this->redirectToRoute('game', array('idGame' => $idGame));
        return $response;
    }

}
