<?php

namespace App\Controller;

use App\Repository\CarRepository;
use App\Repository\RentRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EmployeeController extends AbstractController
{
    #[Route('/employee', name: 'app_employee')]
    public function index(UserRepository $userRepository): Response
    {
        $user = $userRepository->findOneBy(['id' => $this->getUser()]);
        $travels = $user->getTravels();

        return $this->render(
            'employee/index.html.twig',
            ['rents' => $travels]
        );
    }
}
