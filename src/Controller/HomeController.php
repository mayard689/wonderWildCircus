<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="wild_circus_index")
     */
    public function index() :Response
    {
        return new Response(
            '<html><body>Wild Circus HomePage</body></html>'
        );
    }
}
