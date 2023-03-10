<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UsersController extends AbstractController
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
     
    }
    #[Route('api/createUsers', name: 'app_users', methods:['POST', 'GET'])]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $data = $request->getContent();
        $data = json_decode($data, true);

        $user = new User();

        $plaintextPassword = $data['password'];
        $hashedPassword = $this->passwordHasher->hashPassword(
          $user,
          $plaintextPassword
        );

        $user->setNomUser($data['name']);
        $user->setEmail($data['mail']);
        $user->setPrenomUser($data['firstname']);
        $user->setPassword($hashedPassword);
        $user->setPhoneUser($data['phone']);
        $user->setAddrUser($data['address']);
        $user->setCpUser($data['cp']);
        $user->setVilleUser($data['city']);
        $user->setDateNaissance(new \DateTime($data['birth']));
        $user->setProfilPic($data['profil']);
        $user->setCreatedAt(new \DateTimeImmutable());
        $user->setUpdatedAt(new \DateTimeImmutable());

        $entityManager->persist($user);
        $entityManager->flush();

        return new Response('User created', Response::HTTP_CREATED);
    }
}
