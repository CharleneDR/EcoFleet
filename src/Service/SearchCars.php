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

        $correspondingCars = [];
        foreach ($allCars as $car)
        {
            $available = true;
            foreach ($datesOfLocation as $date)
            {
                if($car->getUnavailabilityDates()->contains($date)) {
                    $available = false;
                    continue;
                }
            }    
            if($available == true) {
            $correspondingCars[] = $car;
            }

        }
        return $correspondingCars;
    }
}