<?php

namespace App\Controller;

use App\Entity\Plante;
use App\Entity\TypePlante;
use App\Entity\User;
use App\Repository\TypePlanteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlanteController extends AbstractController
{
    #[Route('api/createPlantes', name: 'app_plantes', methods:['POST', 'GET'])]
    public function index(Request $request, EntityManagerInterface $entityManager, TypePlanteRepository $typePlanteRepo): Response
    {
        $data = $request->getContent();
        $data = json_decode($data, true);

        $typePlante = $entityManager->getRepository(TypePlante::class)->find($data['type']);
        $dataUser = $entityManager->getRepository(User::class)->find($data['user']);

        $plante = new Plante();

        $plante->setNomPlante($data['name']);
        $plante->setDescriptionPlante($data['description']);
        $plante->setImagePlante($data['photo']);
        $plante->setTypePlante($typePlante);
        $plante->setUser($dataUser);
        $plante->setCreatedAt(new \DateTimeImmutable());
        $plante->setUpdatedAt(new \DateTimeImmutable());

        $entityManager->persist($plante);
        $entityManager->flush();

        return new Response('Plante created', Response::HTTP_CREATED);
    }
}
