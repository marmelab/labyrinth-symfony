<?php
namespace App\Tests\Api;

use PHPUnit\Framework\TestCase;

use App\Api\GameApi;
use App\Entity\Game;

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
    }

    private function createGuzzleHttpMockClient($body, $status, $headers)
    {
        $mock = new MockHandler([new Response($status, $headers, $body)]);
        $handler = HandlerStack::create($mock);
        return new Client(['handler' => $handler]);
    }
}
