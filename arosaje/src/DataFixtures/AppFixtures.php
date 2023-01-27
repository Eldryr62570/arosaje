<?php

namespace App\DataFixtures;


use Faker\Factory;
use Faker\Provider\PlanteProvider;
use Doctrine\Persistence\ObjectManager;
use Faker\Provider\UserProviderFixture;
use Faker\Provider\PlanteProviderFixture;
use Faker\Provider\ImageProviderFixture;
use Faker\Provider\CommentaireProviderFixture;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker\Provider\TypeProviderFixture;

class AppFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
     
    }
    
    public function load(ObjectManager $manager): void
    {
        define("NUMBER_USERS" , 100);
        define("NUMBER_PLANTS", 100);
        define("NUMBER_TYPES" , 45);
        define("NUMBER_COMMENT", 115);
        define("NUMBER_PICS", 500);
        $faker = Factory::create('fr_FR');
        $faker->addProvider(new UserProviderFixture($this->passwordHasher));
        $faker->addProvider(new PlanteProviderFixture);
        $faker->addProvider(new TypeProviderFixture);
        $faker->addProvider(new ImageProviderFixture);
        $faker->addProvider(new CommentaireProviderFixture);

        $users = $faker->generateUsers(NUMBER_USERS, $manager);
        $typesPlante = $faker->generateTypesPlante(NUMBER_TYPES, $manager);
        $plantes = $faker->generatePlantes(NUMBER_PLANTS, $users, $typesPlante, $manager);
        $images = $faker->generateImage(NUMBER_PICS, $plantes, $manager);
        $commentaires = $faker->generateCommentaires(NUMBER_COMMENT,$users,$plantes,$manager);
    }
}
