<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Generator;
use Faker\Factory;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i < 10; $i++) {
            $user = new User();
            $user->setEmail($this->faker->email())
                ->setRoles(['ROLE_USER'])
                ->setPlainPassword('password')
                ->setName($this->faker->name())
                ->setFirstname($this->faker->firstName())
                ->setAddress($this->faker->address())
                ->setPostalcode(mt_rand(01000, 98000))
                ->setCity($this->faker->city())
                ->setPhonesNumber(mt_rand(01000, 98000))
                ->setSiret(mt_rand(01000, 98000));


            $manager->persist($user);
        }

        $manager->flush();
    }
}
