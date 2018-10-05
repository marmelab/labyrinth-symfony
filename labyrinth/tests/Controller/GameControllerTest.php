<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

use App\Api\GameApi;
use App\Controller\GameController;

class GameControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/game');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Welcome to Labyrinth Game!")')->count()
        );

        $this->assertEquals(
            7,
            $crawler->filter('.grid-row')->count()
        );

        $this->assertEquals(
            7 * 7 * 3 * 3, // 7x7 cells, 3x3 images per cell
            $crawler->filter('.tile-image')->count()
        );
    }
}
