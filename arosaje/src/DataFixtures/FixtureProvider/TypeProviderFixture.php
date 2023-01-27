<?php
namespace Faker\Provider;

use Faker\Factory;
use DateTimeImmutable;
use App\Entity\TypePlante;
use Doctrine\Persistence\ObjectManager;

class TypeProviderFixture extends \Faker\Provider\Base{
    private $faker = null;
    public function __construct()
    {
      $this->faker = Factory::create("fr_FR");
    }
    private function nomType(){
        return $this->faker->words(3,true);
    }
    private function descriptifType(){
        return $this->faker->paragraph(9);
    }
    private function createdAtDate(){
        return DateTimeImmutable::createFromMutable($this->faker->dateTimeBetween('-100 days', 'now'));
    }
    private function updatedAtDate(){
        return DateTimeImmutable::createFromMutable($this->faker->dateTimeBetween('-100 days', 'now'));
    }
    public function generateTypesPlante(int $numberOfTypes, ObjectManager $manager) : array{
        $typesPlante = [];
        for ($i = 0; $i < $numberOfTypes ; $i++) {
            $typePlante = new TypePlante();
            $typePlante->setCreatedAt($this->createdAtDate())
            ->setDescriptifType($this->descriptifType())
            ->setNomType($this->nomType())
            ->setCreatedAt($this->createdAtDate())
            ->setUpdatedAt($this->updatedAtDate());

            $manager->persist($typePlante);
            $manager->flush();
            $typesPlante[] = $typePlante;
        }
        return $typesPlante;
    }

}