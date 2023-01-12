<?php

namespace App\Service;

use App\Entity\Car;
use App\Entity\Agency;
use App\Repository\CarRepository;
use App\Repository\RentRepository;

class SearchCars
{
    private CarRepository $carRepository;
    private RentRepository $rentRepository;

    public function __construct (CarRepository $carRepository, RentRepository $rentRepository)
    {
        $this->carRepository = $carRepository;
        $this->rentRepository = $rentRepository;
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
                foreach($car->getUnavailabilityDates() as $unavailabilityDate)
                {
                if($unavailabilityDate->getDay() == $date) {
                    $available = false;
                    continue;
                }
            }
            }    
            if($available == true) {
            $correspondingCars[] = $car;
            }

        }
        return $correspondingCars;
    }
    
    public function findCarSharing($pickupDate, $dropoffDate, Agency $location, string $destination): array 
    {
        $rents = $this->rentRepository->findBy(['locationDeparture' => $location, 'locationArrival' => 'destination', 'startDate' => $pickupDate, 'endDate' => $dropoffDate]);
        return $rents;
    }
}