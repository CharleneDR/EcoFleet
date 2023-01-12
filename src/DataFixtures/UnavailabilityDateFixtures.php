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

        $manager->flush();
    }
}
