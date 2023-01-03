<?php

namespace App\DataFixtures;

use App\Entity\Plante;
use App\Entity\ResumePlante;
use Faker\Factory;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 20; $i++) {
            $user = new User();
            $user->setRoles(["ROLE_USER"])
                ->setCreatedAt($faker->dateTime())
                ->setEmail($faker->safeEmail())
                ->setNom($faker->firstName())
                ->setPrenom($faker->lastName())
                ->setPhotoUser("test.jpg")
                ->setAdresse(
                    $faker->buildingNumber()." rue ". 
                    $faker->streetName()." ".
                    $faker->postcode()." ".
                    $faker->city()
                )
                ->setUsername($faker->userName());
            //Tout les users générés auront comme mdp "1234"
            $plaintextPassword = "1234";
            $hashedPassword = $this->passwordHasher->hashPassword(
                $user,
                $plaintextPassword
            );
            $user->setPassword($hashedPassword);
            $manager->persist($user);
            $manager->flush();

            for ($i=0; $i < 5 ; $i++) { 
                $resumePlante = new ResumePlante();
                $resumePlante->setNomResumePlante($faker->word(5));
                $manager->persist($resumePlante);
                $manager->flush();
            }
            
            // Génération des plantes par user présent
            $limitPlant = $faker->randomDigit();

            $resumesPlante = $manager->getRepository(ResumePlante::class)->findAll();
            for ($i = 0; $i < 5; $i++) {
                $plant = new Plante();
                $plant->setUsers($user)
                ->setAdressePlante($faker->buildingNumber()." rue ". 
                    $faker->streetName()." ".
                    $faker->postcode()." ".
                    $faker->city()
                )
                ->setDescriptionPlante($faker->paragraph(3))
                ->setImgPlante($faker->imageUrl(360, 360, 'plant', true))
                ->setIsExterieur($faker->boolean())
                ->setResumePlante();
                
                $manager->persist($plant);
                $manager->flush();
            }
            

        }

        

        $manager->flush();
    }
}
