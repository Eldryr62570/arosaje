<?php

namespace Faker\Provider;

use Faker\Factory;
use App\Entity\User;
use DateTimeImmutable;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserProviderFixture extends \Faker\Provider\Base
{
  private $faker = null;
  public function __construct(private ?UserPasswordHasherInterface $passwordHasher)
  {
    $this->faker = Factory::create("fr_FR");
    $this->passwordHasher = $passwordHasher;
  }
  private function nom()
  {
    return $this->faker->lastName();
  }
  private function prenom()
  {
    return $this->faker->firstName();
  }
  private function addressUser(){
    return $this->faker->address();
  }
  private function codePostal(){
    return $this->faker->postcode();
  }
  private function createdAtDate(){
    return DateTimeImmutable::createFromMutable($this->faker->dateTimeBetween('-100 days', 'now'));
  }
  private function updatedAtDate(){
    return DateTimeImmutable::createFromMutable($this->faker->dateTimeBetween('-100 days', 'now'));
  }
  private function emailUser(){
    return $this->faker->email();
  }
  private function dateNaissance(){
    return $this->faker->dateTimeBetween('-120 years','now');
  }
  private function profilPic(){
    return $this->faker->imageUrl();
  }
  private function phoneNumber(){
    return $this->faker->phoneNumber();
  }
  private function roleUser(){
    return ["ROLE_USER"];
  }
  private function passwordUser(User $user){
    $plaintextPassword = "1234";
        $hashedPassword = $this->passwordHasher->hashPassword(
          $user,
          $plaintextPassword
        );
    return $hashedPassword;
  }
  public function generateUsers(int $numberOfUser , ObjectManager $manager):array{
    $users = [];
    for ($i = 0; $i < $numberOfUser ; $i++) {
      $user = new User();
      $user->setAddrUser($this->addressUser())
      ->setCpUser($this->codePostal())
      ->setCreatedAt($this->createdAtDate())
      ->setDateNaissance($this->dateNaissance())
      ->setEmail($this->emailUser())
      ->setNomUser($this->nom())
      ->setPassword($this->passwordUser($user))
      ->setProfilPic($this->profilPic())
      ->setRoles($this->roleUser())
      ->setPrenomUser($this->prenom())
      ->setPhoneUser($this->phoneNumber())
      ->setUpdatedAt($this->updatedAtDate());
      $manager->persist($user);
      $manager->flush();
      $users[] = $user;
    }
    return $users;
  }
}