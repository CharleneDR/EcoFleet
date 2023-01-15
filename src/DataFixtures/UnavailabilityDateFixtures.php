<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\UnavailabilityDate;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class UnavailabilityDateFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $date1 = new UnavailabilityDate();
        $date1->setCar($this->getReference('GG-434-FK'));
        $date1->setDay(new DateTime('2023-01-02'));
        $manager->persist($date1);

        $date2 = new UnavailabilityDate();
        $date2->setCar($this->getReference('GG-434-FK'));
        $date2->setDay(new DateTime('2023-01-03'));
        $manager->persist($date2);

        $date3 = new UnavailabilityDate();
        $date3->setCar($this->getReference('GG-434-FK'));
        $date3->setDay(new DateTime('2023-01-04'));
        $manager->persist($date3);

        $date4 = new UnavailabilityDate();
        $date4->setCar($this->getReference('EX-432-LK'));
        $date4->setDay(new DateTime('2023-01-10'));
        $manager->persist($date4);

        $date5 = new UnavailabilityDate();
        $date5->setCar($this->getReference('EX-432-LK'));
        $date5->setDay(new DateTime('2023-01-11'));
        $manager->persist($date5);

        $date6 = new UnavailabilityDate();
        $date6->setCar($this->getReference('EX-432-LK'));
        $date6->setDay(new DateTime('2023-01-12'));
        $manager->persist($date6);

        $date7 = new UnavailabilityDate();
        $date7->setCar($this->getReference('IC-564-LK'));
        $date7->setDay(new DateTime('2023-01-11'));
        $manager->persist($date7);

        $date8 = new UnavailabilityDate();
        $date8->setCar($this->getReference('IC-564-LK'));
        $date8->setDay(new DateTime('2023-01-12'));
        $manager->persist($date8);

        $date9 = new UnavailabilityDate();
        $date9->setCar($this->getReference('IC-564-LK'));
        $date9->setDay(new DateTime('2023-01-13'));
        $manager->persist($date9);

        $date10 = new UnavailabilityDate();
        $date10->setCar($this->getReference('FZ-233-VE'));
        $date10->setDay(new DateTime('2023-01-07'));
        $manager->persist($date10);

        $date11 = new UnavailabilityDate();
        $date11->setCar($this->getReference('FZ-233-VE'));
        $date11->setDay(new DateTime('2023-01-08'));
        $manager->persist($date11);

        $date12 = new UnavailabilityDate();
        $date12->setCar($this->getReference('FZ-233-VE'));
        $date12->setDay(new DateTime('2023-01-09'));
        $manager->persist($date12);

        $manager->flush();
    }
}
