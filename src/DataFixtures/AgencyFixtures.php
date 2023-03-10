<?php

namespace App\DataFixtures;

use App\Entity\Agency;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AgencyFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $agency = new Agency();
        $agency->setCity('Paris');
        $manager->persist($agency);
        $this->addReference('Paris', $agency);

        $agency1 = new Agency();
        $agency1->setCity('Lyon');
        $manager->persist($agency1);
        $this->addReference('Lyon', $agency1);

        $agency2 = new Agency();
        $agency2->setCity('Nantes');
        $manager->persist($agency2);
        $this->addReference('Nantes', $agency2);

        $manager->flush();
    }
}
