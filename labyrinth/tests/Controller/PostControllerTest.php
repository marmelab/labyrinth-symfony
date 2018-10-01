<?php
// tests/Controller/PostControllerTest.php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostControllerTest extends WebTestCase
{
    public function testShowPost()
    {
        $client = static::createClient();

        $client->request('GET', '/hello');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testHelloCrawler()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/hello');

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Hello World")')->count()
        );

        $this->assertGreaterThan(0, $crawler->filter('h1')->count());
    }
}
