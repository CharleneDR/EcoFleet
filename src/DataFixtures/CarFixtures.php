<?php

namespace App\DataFixtures;

use App\Entity\Car;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CarFixtures extends Fixture
{
    public const CARS = [
        [
            'model' => 'Megane',
            'brand' => "Renault",
            'fuel' => 'Gasoline',
            'geerbox' => 'Manual',
            'kilometers' => '45098',
            'seats' => '4',
            'unavailabilitydate' => '2023-01-12',
            'city' => 'Paris',
            'registration' => 'EX-432-LK',
            'picture' => 'https://cdn.group.renault.com/ren/master/renault-new-cars/product-plans/megane/megane-bfb-ph2/2560x1440-responsive-format/renault-megane4-ph2-exterior-3d-001.jpg.ximg.xsmall.jpg/4f0f19c43a.jpg'
        ],
        [
            'model' => 'A3',
            'brand' => "Audi",
            'fuel' => 'Diesel',
            'geerbox' => 'Automatic',
            'kilometers' => '32000',
            'seats' => '4',
            'unavailabilitydate' => '2023-01-13',
            'city' => 'Lyon',
            'registration' => 'GG-434-FK',
            'picture' => 'https://sf1.autojournal.fr/wp-content/uploads/autojournal/2020/06/Audi_A3_Berline_2020_e3aa8.jpg'
        ],
        [
            'model' => 'Model3',
            'brand' => "Tesla",
            'fuel' => 'Electric',
            'geerbox' => 'Automatic',
            'kilometers' => '17102',
            'seats' => '4',
            'unavailabilitydate' => '2023-01-15',
            'city' => 'Nantes',
            'registration' => 'EX-432-LK',
            'picture' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQarETPfHxeyk2xcHuV1OvdiGWmwNh95QBeiQ&usqp=CAU'
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::CARS as $values) {
            $car = new Car();
            $car->setModel($values['model']);
            $car->setBrand($values['brand']);
            $car->setFuel($values['fuel']);
            $car->setGeerbox($values['geerbox']);
            $car->setKilometers($values['kilometers']);
            $car->setSeats($values['seats']);
            $car->setUnavailabilitydate(new \DateTime($values['unavailabilitydate']));
            $car->setCity($this->getReference('city'));
            $car->setRegistration($values['registration']);
            $car->setPicture($values['picture']);

            $manager->persist($car);
        }
        $manager->flush();
    }
}