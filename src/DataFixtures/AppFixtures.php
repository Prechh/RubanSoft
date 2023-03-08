<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Faker\Generator;
use App\Entity\Article;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
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
        // User
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

        // Article
        for ($l = 1; $l < 10; $l++) {
            $article = new Article();
            $article->setName($this->faker->word())
                ->setRefFilm(mt_rand(00001, 99999))
                ->setCodeMachine(mt_rand(00001, 99999))
                ->setPrice(mt_rand(10, 999));

            $manager->persist($article);
        }


        $manager->flush();
    }
}
