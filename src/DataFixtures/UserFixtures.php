<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $employee = new User();
        $employee->setEmail('user@spectrasociety.com');
        $employee->setRoles(['ROLE_EMPLOYEE']);
        $hashedPassword = $this->passwordHasher->hashPassword(
            $employee,
            'user1234'
        );

        $employee->setPassword($hashedPassword);
        $this->addReference('Employee', $employee);
        $manager->persist($employee);

        $employee1 = new User();
        $employee1->setEmail('jocelyne@spectrasociety.com');
        $employee1->setRoles(['ROLE_EMPLOYEE']);
        $hashedPassword = $this->passwordHasher->hashPassword(
            $employee1,
            'jocelyne1234'
        );

        $employee1->setPassword($hashedPassword);
        $this->addReference('Employee1', $employee1);
        $manager->persist($employee1);

        $company = new User();
        $company->setEmail('company@spectrasociety.com');
        $company->setRoles(['ROLE_COMPANY']);
        $hashedPassword = $this->passwordHasher->hashPassword(
            $company,
            'company1234'
        );

        $company->setPassword($hashedPassword);
        $manager->persist($company);

        $admin = new User();
        $admin->setEmail('admin@spectrasociety.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $hashedPassword = $this->passwordHasher->hashPassword(
            $admin,
            'admin1234'
        );

        $admin->setPassword($hashedPassword);
        $manager->persist($admin);

        $manager->flush();
    }
}
