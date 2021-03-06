<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GameControllerTest extends WebTestCase
{
    public function testCreateGame()
    {
        $client = static::createClient();
        $client->followRedirects();
        $crawler = $client->request('GET', '/createGame');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Welcome to Labyrinth Game!")')->count()
        );

        $this->assertEquals(
            7 * 7,
            $crawler->filter('.tile-grid.pathCard')->count(),
            '7 x 7 path-cards on the board'
        );

        $this->assertEquals(
            1,
            $crawler->filter('.tile-grid.remainingPathCard')->count(),
            '1 remaining path-cards'
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
            24,
            $crawler->filter('.tile-asset.target')->count(),
            '24 treasures on the board+remainingPathCard'
        );
    }
}
