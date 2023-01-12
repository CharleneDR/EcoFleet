<?php

namespace App\DataFixtures;

use App\Entity\Agency;
use App\Entity\Employee;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class EmployeeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $employee = new Employee();
        $employee->setFirstname('Jean-Michel');
        $employee->setLastname('Employee');
        $employee->setUser($this->getReference('Employee'));
        $manager->persist($employee);

        $employee1 = new Employee();
        $employee1->setFirstname('Jocelyne');
        $employee1->setLastname('Gerard');
        $employee1->setUser($this->getReference('Employee1'));
        $manager->persist($employee1);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}
