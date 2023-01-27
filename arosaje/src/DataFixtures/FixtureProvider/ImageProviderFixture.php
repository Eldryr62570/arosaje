<?php
namespace Faker\Provider;

use App\Entity\ImagesPlante;
use Faker\Factory;
use DateTimeImmutable;
use Doctrine\Persistence\ObjectManager;

class ImageProviderFixture extends \Faker\Provider\Base{
    private $faker = null;
    public function __construct()
    {
      $this->faker = Factory::create("fr_FR");
    }
    private function lienImage(){
      return $this->faker->imageUrl();
    }
    private function createdAt(){
        return DateTimeImmutable::createFromMutable($this->faker->dateTimeBetween('-100 days', 'now'));
    }
    private function updatedAt(){
      return DateTimeImmutable::createFromMutable($this->faker->dateTimeBetween('-100 days', 'now'));
    }
    private function getRandomPlante(array $plantes){
      $randomPlante = $plantes[array_rand($plantes)];
      return $randomPlante;
    }
    public function generateImage(int $numberOfImages,array $plantes,ObjectManager $manager){
      $images = [];
        for ($i = 0; $i < $numberOfImages ; $i++) {
            $image = new ImagesPlante();
            $image->setCreatedAt($this->createdAt())
            ->setLienImage($this->lienImage())
            ->setUpdatedAt($this->updatedAt())
            ->setPlante($this->getRandomPlante($plantes));
            $manager->persist($image);
            $manager->flush();
            $images[] = $image;
        }
        return $images;
    }
}