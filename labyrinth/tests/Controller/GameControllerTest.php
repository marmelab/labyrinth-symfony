<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

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
            7 * 7 + 1,
            $crawler->filter('.tile-grid')->count(),
            '7 x 7 + 1 for remainingPathCard'
        );

        $this->assertEquals(
            1,
            $crawler->filter('.player-grid')->count()
        );

        $this->assertEquals(
            (7 * 7 + 1) * 3 * 3,
            $crawler->filter('.tile-image')->count(),
            '7x7+1 cells, 3x3 images per cell'
        );

        $this->assertEquals(
            23,
            $crawler->filter('.tile-asset.target')->count(),
            '23 treasures on the board'
        );
    }
}
