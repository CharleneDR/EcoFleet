<?php

namespace App\Controller;

use DateTime;
use DatePeriod;
use DateInterval;
use App\Entity\Car;
use App\Entity\Rent;
use App\Entity\User;
use App\Form\RentType;
use App\Repository\CarRepository;
use App\Entity\UnavailabilityDate;
use App\Repository\RentRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UnavailabilityDateRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/rent')]
class RentController extends AbstractController
{
    #[Route('/', name: 'app_rent_index', methods: ['GET'])]
    public function index(RentRepository $rentRepository): Response
    {
        return $this->render('rent/index.html.twig', [
            'rents' => $rentRepository->findAll(),
        ]);
    }

    #[Route('/new/{id}/{locationDeparture}/{locationArrival}/{startDate}/{endDate}', name: 'app_rent_new', methods: ['GET', 'POST'])]
    public function newRent(Car $car, RentRepository $rentRepository, $locationDeparture, $locationArrival, $startDate, $endDate, Request $request, UnavailabilityDateRepository $unavailabilityDateRepository): Response
    {
        $rent = new rent();

        $rent->setCar($car);
        $rent->setLocationDeparture($locationDeparture);
        $rent->setLocationArrival($locationArrival);
        $rent->setStartDate(new DateTime($startDate));
        $rent->setEndDate(new DateTime($endDate));

        /** @var User $user */
        $user = $this->getUser();

        $rent->addPassenger($user);
        $rent->addEmployee($user->getEmployee());

        $pickupDate = new \DateTime($startDate);
        $dropoffDate = new \Datetime($endDate);

        $interval = DateInterval::createFromDateString('1 day');
        $daterange = new DatePeriod($pickupDate, $interval ,$dropoffDate->modify('+1 day'));

        foreach($daterange as $day){
            $unavailabilityDay = new UnavailabilityDate();
            $unavailabilityDay->setDay($day);
            $unavailabilityDay->setCar($car);
            $unavailabilityDateRepository->save($unavailabilityDay, true);
        }

        $rentRepository->save($rent, true);

        return $this->redirectToRoute('app_home');
    }

    #[Route('/{id}', name: 'app_rent_carSharing', methods: ['GET'])]
    public function carSharing(Rent $rent, RentRepository $rentRepository): Response
    {
        if(sizeof($rent->getPassenger()) < $rent->getCar()->getSeats()) {
            /** @var User $user */
            $rent->addPassenger($this->getUser());
            $rentRepository->save($rent, true);
        }
        return $this->redirectToRoute('app_home');
    }

    #[Route('/{id}/edit', name: 'app_rent_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Rent $rent, RentRepository $rentRepository): Response
    {
        $form = $this->createForm(RentType::class, $rent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $rentRepository->save($rent, true);

            return $this->redirectToRoute('app_rent_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('rent/edit.html.twig', [
            'rent' => $rent,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_rent_delete', methods: ['POST'])]
    public function delete(Request $request, Rent $rent, RentRepository $rentRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $rent->getId(), $request->request->get('_token'))) {
            $rentRepository->remove($rent, true);
        }

        return $this->redirectToRoute('app_rent_index', [], Response::HTTP_SEE_OTHER);
    }
}
