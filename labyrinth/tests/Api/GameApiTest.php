<?php

namespace App\Tests\Api;

use PHPUnit\Framework\TestCase;

use App\Api\GameApi;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

class GameApiTest extends TestCase
{
    public function testCreateGame()
    {
        $mockedResponse = file_get_contents(__DIR__ . '/../../data/board-example.json');
        $client = $this->createGuzzleHttpMockClient($mockedResponse, 200, ['Content-Type' => 'application/json']);
        $gameApi = new GameApi($client);

        $game = $gameApi->createGame();

        $numberOfRows = count($game->getBoard());
        $this->assertEquals(7, $numberOfRows);
        foreach ($game->getBoard() as $row) {
            $this->assertEquals(7, count($row));
        }

        $this->assertNotNull($game->getRemainingPathCard());
        $this->assertNotEmpty($game->getPlayers());
        $this->assertNotEmpty($game->getScores());
        $this->assertNotNull($game->getCurrentIndexOfPathCardInsertionPosition());
        $this->assertNotNull($game->getCurrentPlayerIndex());
        $this->assertNotNull($game->getState());
        $this->assertNotEmpty($game->getReachablePositions());

        $this->assertEquals(count($game->getPlayers()), count($game->getScores()));
        $this->assertEquals(count($game->getPlayers()), count($game->getReachablePositions()));


        $nbTarget = 0;
        foreach ($game->getBoard() as $row) {
            foreach ($row as $pathCard) {
                if (!is_null($pathCard['target'])) {
                    $nbTarget = $nbTarget + 1;
                }
            }
        }
        $remainingPathCard = $game->getRemainingPathCard();
        if (!is_null($remainingPathCard['target'])) {
            $nbTarget = $nbTarget + 1;
        }
        $this->assertEquals(24, $nbTarget);

    }

    private function createGuzzleHttpMockClient($body, $status, $headers)
    {
        $mock = new MockHandler([new Response($status, $headers, $body)]);
        $handler = HandlerStack::create($mock);
        return new Client(['handler' => $handler]);
    }
}
