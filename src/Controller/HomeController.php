<?php

namespace App\Controller;

use App\Repository\ArtistRepository;
use App\Repository\ShowRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="wild_circus_index")
     */
    public function index(ShowRepository $showRepository, ArtistRepository $artistRepository) :Response
    {
        $shows = $showRepository->findComming();
        $artists = $artistRepository->findThree();

        return $this->render('home/index.html.twig', [
            'shows' => $shows,
            'artists' => $artists,
        ]);
    }
}
