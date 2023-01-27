<?php
namespace Faker\Provider;

use App\Entity\Commentaire;
use Faker\Factory;
use DateTimeImmutable;
use Doctrine\Persistence\ObjectManager;

class CommentaireProviderFixture extends \Faker\Provider\Base{
    private $faker = null;
    public function __construct()
    {
      $this->faker = Factory::create("fr_FR");
    }
    public function texteCommentaire(){
        return $this->faker->paragraph(40);
    }
    private function createdAt(){
        return DateTimeImmutable::createFromMutable($this->faker->dateTimeBetween('-100 days', 'now'));
    }
    private function updatedAt(){
      return DateTimeImmutable::createFromMutable($this->faker->dateTimeBetween('-100 days', 'now'));
    }
    private function getRandomPlant(array $plantes){
        $randomPlante = $plantes[array_rand($plantes)];
        return $randomPlante;
    }
    private function getRandomUser(array $user){
        $randomUser= $user[array_rand($user)];
        return $randomUser;
    }
    public function generateCommentaires(int $numberOfCommentaire,array $users, array $plantes,ObjectManager $manager){
        $commentaires = [];
        for ($i = 0; $i < $numberOfCommentaire ; $i++) {
            $commentaire = new Commentaire();
            $commentaire->setCreatedAt($this->createdAt())
            ->setPlante($this->getRandomPlant($plantes))
            ->setUser($this->getRandomUser($users))
            ->setTexteCommentaire($this->faker->paragraph(8))
            ->setCreatedAt($this->createdAt())
            ->setUpdatedAt($this->updatedAt());

            $manager->persist($commentaire);
            $manager->flush();
            $commentaires[] = $commentaire;
        }
        return $commentaires;
    }
}