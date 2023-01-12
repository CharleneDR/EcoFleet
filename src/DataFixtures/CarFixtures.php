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
            'city' => 'Paris',
            'registration' => 'EX-432-LK',
            'picture' => 'https://cdn.group.renault.com/ren/master/renault-new-cars/product-plans/megane/megane-bfb-ph2/2560x1440-responsive-format/renault-megane4-ph2-exterior-3d-001.jpg.ximg.xsmall.jpg/4f0f19c43a.jpg',
            'available' => 0,
        ],
        [
            'model' => 'A3',
            'brand' => "Audi",
            'fuel' => 'Diesel',
            'geerbox' => 'Automatic',
            'kilometers' => '32000',
            'seats' => '4',
            'city' => 'Lyon',
            'registration' => 'GG-434-FK',
            'picture' => 'https://sf1.autojournal.fr/wp-content/uploads/autojournal/2020/06/Audi_A3_Berline_2020_e3aa8.jpg',
            'available' => 1
        ],
        [
            'model' => 'Model3',
            'brand' => "Tesla",
            'fuel' => 'Electric',
            'geerbox' => 'Automatic',
            'kilometers' => '17102',
            'seats' => '4',
            'city' => 'Nantes',
            'registration' => 'IC-564-LK',
            'picture' => 'https://www.topvelo.fr/storage/2020/08/Tesla-model-3-DSCF8897.jpg',
            'available' => 1
        ],
        [
            'model' => 'C4',
            'brand' => "Citroën",
            'fuel' => 'Electric',
            'geerbox' => 'Automatic',
            'kilometers' => '12098',
            'seats' => '4',
            'city' => 'Lyon',
            'registration' => 'FZ-233-VE',
            'picture' => 'https://images.caradisiac.com/images/1/1/2/8/191128/S1-essai-citroen-c4-bluehdi-110-ch-684826.jpg',
            'available' => 0
        ],
        [
            'model' => 'DS4',
            'brand' => "Citroën",
            'fuel' => 'Diesel',
            'geerbox' => 'Automatic',
            'kilometers' => '240893',
            'seats' => '4',
            'city' => 'Paris',
            'registration' => 'IG-074-MD',
            'picture' => 'https://auto.cdn-rivamedia.com/photos/annonce/big/citroen-ds4-16-e-hdi115-airdream-so-chic-etg6-134193135.jpg',
            'available' => 1
        ],
        [
            'model' => 'DS5',
            'brand' => "Citroën",
            'fuel' => 'Diesel',
            'geerbox' => 'Automatic',
            'kilometers' => '310894',
            'seats' => '4',
            'city' => 'Nantes',
            'registration' => 'CD-564-LK',
            'picture' => 'https://www.turbo.fr/sites/default/files/styles/article_690x405/public/migration/newscast/field_image/000000004489816.jpg?itok=YJiuS8Ah',
            'available' => 1
        ],
        [
            'model' => 'Golf VI',
            'brand' => "Volkswagen",
            'fuel' => 'Electric',
            'geerbox' => 'Automatic',
            'kilometers' => '170564',
            'seats' => '4',
            'city' => 'Nantes',
            'registration' => 'GC-764-PK',
            'picture' => 'https://www.largus.fr/images/images/Volkswagen-e-Golf-electrique-2014_32.JPG',
            'available' => 1
        ],
        [
            'model' => 'Tiguan',
            'brand' => "Volkswagen",
            'fuel' => 'Gasoline',
            'geerbox' => 'Automatic',
            'kilometers' => '281061',
            'seats' => '4',
            'city' => 'Lyon',
            'registration' => 'FC-124-AE',
            'picture' => 'https://www.automobile-magazine.fr/asset/cms/840x394/155988/config/109407/les-quatre-sorties-dechappement-caracteristiques-des-versions-r-trahissent-ce-prototype.jpg',
            'available' => 1
        ],
        [
            'model' => 'Touareg',
            'brand' => "Volkswagen",
            'fuel' => 'Diesel',
            'geerbox' => 'Automatic',
            'kilometers' => '150891',
            'seats' => '4',
            'city' => 'Lyon',
            'registration' => 'CR-074-PL',
            'picture' => 'https://www.gaillardauto.com/content/uploads/2022/08/f9e1056a-56be-4f61-8523-45bcf164cded.jpg',
            'available' => 1
        ],
        [
            'model' => 'Ami',
            'brand' => "Citroen",
            'fuel' => 'Electric',
            'geerbox' => 'Automatic',
            'kilometers' => '20',
            'seats' => '2',
            'city' => 'Paris',
            'registration' => 'GG-666-VW',
            'picture' => 'https://sf2.autojournal.fr/wp-content/uploads/autojournal/2021/10/post-ami-flammes-centre.jpg',
            'available' => 1
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
            $car->setCity($this->getReference($values['city']));
            $car->setRegistration($values['registration']);
            $car->setAvailable($values['available']);
            $car->setPicture($values['picture']);
            $this->addReference($values['registration'], $car);

            $manager->persist($car);
        }
        $manager->flush();
    }
}
