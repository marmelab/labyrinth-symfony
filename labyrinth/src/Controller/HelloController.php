<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HelloController extends AbstractController
{
    /**
     * @Route("/hello")
     */
    public function index()
    {
        return $this->render('hello.html.twig');
    }

    public function sayHello(): string
    {
        return 'Hello World!';
    }
}
