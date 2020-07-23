<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\Show;
use App\Form\BookingType;
use App\Repository\ArtistRepository;
use App\Repository\ShowRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="wild_circus_index")
     */
    public function index(ShowRepository $showRepository, ArtistRepository $artistRepository) :Response
    {
        $shows = $showRepository->findComming(6);
        $artists = $artistRepository->findThree();

        return $this->render('home/index.html.twig', [
            'shows' => $shows,
            'artists' => $artists,
        ]);
    }

    /**
     * @Route("/book/{id}", name="wild_circus_book")
     */
    public function book(Request $request, Show $show, ShowRepository $showRepository, ArtistRepository $artistRepository, ?UserInterface $user)
    {

        if ($user == null) {
            return $this->redirectToRoute('app_login');
        }

        $booking = new Booking();
        $booking->setUser($user);
        $booking->setRepresentation($show);
        $booking->setAdult(1);
        $booking->setChild(0);

        $form = $this->createForm(BookingType::class, $booking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if($user != $booking->getUser()) {
                $this->addFlash('danger', 'Votre réservation pour la représentation de "'.$booking->getRepresentation()->getCity().'" n\'a pas pu être enregistrée.');
                return $this->redirectToRoute('wild_circus_index');
            }

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($booking);
            $entityManager->flush();

            $this->addFlash('success', 'Votre réservation pour la représentation de "'.$booking->getRepresentation()->getCity().'" a été enregistrée');
            return $this->redirectToRoute('wild_circus_index');
            //$this->sendNewProgramNotification($program, $mailer);


        }

        return $this->render('home/book.html.twig', [
            'show' => $show,
            'form' => $form->createView(),
        ]);
    }
}
