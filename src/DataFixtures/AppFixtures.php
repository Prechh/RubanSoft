<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Faker\Generator;
use App\Entity\Article;
use App\Entity\Commande;
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
        $users = [];
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

            $users[] = $user;
            $manager->persist($user);
        }

        // Article
        $articles = [];
        for ($j = 1; $j < 30; $j++) {
            $article = new Article();
            $article->setName($this->faker->word())
                ->setRefFilm(mt_rand(00001, 99999))
                ->setCodeMachine(mt_rand(00001, 99999))
                ->setPrice(mt_rand(10, 999));

            $articles[] = $article;
            $manager->persist($article);
        }


        //Commande
        for ($k = 0; $k < 10; $k++) {
            $commande = new Commande();
            $commande->setQuantity(mt_rand(1, 5))
                ->setDateDelivery($this->faker->date())
                ->setArticles($articles[mt_rand(0, count($articles) - 1)])
                ->setPrice(mt_rand(10, 200))
                ->setClient($users[mt_rand(0, count($users) - 1)])
                ->setState("0")
                ->setSiret(mt_rand(01000, 98000))
                ->setName($this->faker->name())
                ->setFirstname($this->faker->firstName())
                ->setAddress($this->faker->address())
                ->setPostalcode(mt_rand(01000, 98000))
                ->setCity($this->faker->city());



            $manager->persist($commande);
        }


        $manager->flush();
    }
}
