<?php

namespace App\Controller;

use App\Form\SearchCarType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(SearchCarType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $errors = [];
            $pickupDate = $form->getData()['pickUpDate'];
            $dropoffDate = $form->getData()['dropOffDate'];
            $location = $form->getData()['pickUpLocation'];
            $destination = $form->getData()['destination'];
            if ($pickupDate > $dropoffDate) {
                $errors[] = 'Drop-off date must be before pick-up date';
            }

            if ($errors != []) {
                return $this->render('home/index.html.twig', [
                    'form' => $form
                ]);
            }

            return $this->redirectToRoute('app_car_result', [
                'startDate' => $pickupDate->format('Y-m-d'),
                'endDate' => $dropoffDate->format('Y-m-d'),
                'startLocation' => $location->getCity(),
                'endLocation' => $destination
            ], Response::HTTP_SEE_OTHER);

        }

        return $this->render('home/index.html.twig', [
            'form' => $form
        ]);
    }
}
