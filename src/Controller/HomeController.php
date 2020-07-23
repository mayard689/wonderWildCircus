<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\Show;
use App\Form\BookingType;
use App\Repository\ArtistRepository;
use App\Repository\BookingRepository;
use App\Repository\ShowRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
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
     * @Route("/my-account", name="wild_circus_account")
     */
    public function userPage(
        BookingRepository $bookingRepository,
        ArtistRepository $artistRepository,
        ?UserInterface $user
    ) :Response {
        $bookings = $bookingRepository->findBy(array('user' => $user ));
        $artists = $artistRepository->findThree();

        return $this->render('home/account.html.twig', [
            'bookings' => $bookings,
            'artists' => $artists,
        ]);
    }

    /**
     * @Route("/book/{id}", name="wild_circus_book")
     */
    public function book(
        Request $request,
        Show $show,
        BookingRepository $bookingRepository,
        ?UserInterface $user,
        MailerInterface $mailer
    ) {
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

            $usedPlaces = $bookingRepository->countUsedPlaces($booking->getRepresentation());
            $remainingPlaces = $booking->getRepresentation()->getQuantity() - $usedPlaces;
            if ( $remainingPlaces < $booking->getAdult() + $booking->getChild()) {
                $this->addFlash('danger', 'Il reste seulement '.$remainingPlaces.'places disponibles pour la représentation que vous avez choisi.');
                return $this->redirectToRoute('wild_circus_book', ['id' => $booking->getRepresentation()->getId()]);
            }

            if ($user != $booking->getUser()) {
                $this->addFlash('danger', 'Votre réservation pour la représentation de "'.$booking->getRepresentation()->getCity().'" n\'a pas pu être enregistrée.');
                return $this->redirectToRoute('wild_circus_index');
            }

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($booking);
            $entityManager->flush();

            $this->addFlash('success', 'Votre réservation pour la représentation de "'.$booking->getRepresentation()->getCity().'" a été enregistrée');
            $this->sendNewProgramNotification($booking, $mailer, $user->getUsername());
            return $this->redirectToRoute('wild_circus_index');


        }

        return $this->render('home/book.html.twig', [
            'show' => $show,
            'form' => $form->createView(),
        ]);
    }

    private function sendNewProgramNotification(Booking $booking, MailerInterface $mailer, string $email)
    {

        //$mailerFrom=$this->getParameter("mailer_from");
        $email = (new Email())
            ->from('doc-albert@laposte.net')
            ->to($email)
            ->subject('Votre réservation a bien été prise en compte')
            ->html($this->renderView('email/notification.html.twig',[
                'booking' => $booking,
            ]));

        $mailer->send($email);
    }
}
