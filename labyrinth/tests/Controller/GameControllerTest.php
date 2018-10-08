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
            7 * 7 + 1, // +1 for remainingPathCard
            $crawler->filter('.tile-grid')->count()
        );

        $this->assertEquals(
            1,
            $crawler->filter('.player-grid')->count()
        );

        $this->assertEquals(
            (7 * 7 + 1) * 3 * 3, // 7x7+1 cells, 3x3 images per cell
            $crawler->filter('.tile-image')->count()
        );
    }
}
