<?php

namespace App\Controller;

use App\Entity\Rent;
use App\Form\RentType;
use App\Repository\RentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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

    #[Route('/new', name: 'app_rent_new', methods: ['GET', 'POST'])]
    public function new(Request $request, RentRepository $rentRepository, UnavailabilityDateRepository $unavailabilityDateRepository): Response
    {
        $rent = new Rent();
        $form = $this->createForm(RentType::class, $rent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pickupDate = new \DateTime("2021-01-01");
            $dropoffDate = new \Datetime("2021-01-05");

            $interval = DateInterval::createFromDateString('1 day');
            $daterange = new DatePeriod($pickupDate, $interval ,$dropoffDate);

            foreach($daterange as $day){
                $unavailabilityDay = new UnavailabilityDateRepository();
                $unavailabilityDay->setDay($day);
                $unavailabilityDateRepository->save($unavailabilityDay, true);
            }

            $rentRepository->save($rent, true);

            return $this->redirectToRoute('app_rent_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('rent/new.html.twig', [
            'rent' => $rent,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_rent_show', methods: ['GET'])]
    public function show(Rent $rent): Response
    {
        return $this->render('rent/show.html.twig', [
            'rent' => $rent,
        ]);
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
        if ($this->isCsrfTokenValid('delete'.$rent->getId(), $request->request->get('_token'))) {
            $rentRepository->remove($rent, true);
        }

        return $this->redirectToRoute('app_rent_index', [], Response::HTTP_SEE_OTHER);
    }
}
