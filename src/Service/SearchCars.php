<?php

namespace App\Service;

use App\Entity\Car;
use App\Entity\Agency;
use App\Repository\CarRepository;

class SearchCars
{
    private CarRepository $carRepository;

    public function __construct (CarRepository $carRepository)
    {
        $this->carRepository = $carRepository;
    }

    public function findCorrespondingCars(array $datesOfLocation, Agency $location): array 
    {
        $allCars = $this->carRepository->findBy(['city' => $location, 'Available' => true]);
        /*
        $correspondingCars = [];
        foreach ($datesOfLocation as $date)
        {
            foreach ($allCars as $car)
            {
                if(!in_array($date, $car->getUnavailabilityDates())) {
                    $correspondingCars[] = $car;
                }
            }
        }
        */
        
        return $allCars;
    }
}