<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GameControllerTest extends WebTestCase
{
    public function testShowPost()
    {
        $client = static::createClient();

        $client->request('GET', '/game');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testGameCrawler()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/game');

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Labyrinth Game")')->count()
        );

        $this->assertGreaterThan(0, $crawler->filter('h1')->count());
    }
}
