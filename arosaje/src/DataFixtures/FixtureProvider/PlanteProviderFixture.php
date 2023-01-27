<?php
namespace Faker\Provider;

use Faker\Factory;
use App\Entity\Plante;
use DateTimeImmutable;
use Doctrine\Persistence\ObjectManager;


class PlanteProviderFixture extends \Faker\Provider\Base{
    private $faker = null;
    public function __construct()
    {
      $this->faker = Factory::create("fr_FR");
    }
    private function nomPlante(){
        return $this->faker->words(3,true);
    }
    private function descriptionPlante(){
        return $this->faker->paragraph(4);
    }
    private function imagePlante(){
        return $this->faker->imageUrl();
    }
    private function createdAt(){
        return DateTimeImmutable::createFromMutable($this->faker->dateTimeBetween('-100 days', 'now'));
    }
    private function updatedAt(){
        return DateTimeImmutable::createFromMutable($this->faker->dateTimeBetween('-100 days', 'now'));
    }
    private function getRandomUser(array $users){
        $randomUser = $users[array_rand($users)];
        return $randomUser;
    }
    private function getRandomType(array $types){
        $randomType = $types[array_rand($types)];
        return $randomType;
    }
    public function generatePlantes(int $numberOfPlantes,array $usersArray,array $typesPlante, ObjectManager $manager):array{
        $plantes = [];
        for ($i = 0; $i < $numberOfPlantes ; $i++) {
            $plante = new Plante();
            $plante->setCreatedAt($this->createdAt())
            ->setDescriptionPlante($this->descriptionPlante())
            ->setImagePlante($this->imagePlante())
            ->setUpdatedAt($this->updatedAt())
            ->setUser($this->getRandomUser($usersArray))
            ->setNomPlante($this->nomPlante())
            ->setTypePlante($this->getRandomType($typesPlante));

            $manager->persist($plante);
            $manager->flush();
            $plantes[] = $plante;
        }
        return $plantes;
    }
}
