<?php

// src/Controller/SecurityController.php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    #[Route('/api/login_check', methods: ['POST', 'GET'])]
    public function login(Request $request)
    {
        // Get the username and password from the request
        $username = $request->request->get("username");
        $password = $request->request->get("password");

        // Find the user by username
        $userRepository = $this->entityManager->getRepository(User::class);
        $user = $userRepository->findOneBy(['email' => $username]);

        // Verify the password
        if ($user && password_verify($password, $user->getPassword())) {
            // Create a JWT token using LexikJWTAuthenticationBundle
            $token = $this->get('lexik_jwt_authentication.encoder')
                ->encode([
                    'email' => $user->getEmail(),
                    'roles' => $user->getRoles(),
                ]);
            return $this->json(['token' => $token]);
        } else {
            return $this->json(['error' => 'Invalid credentials'], 401);
        }
    }

    #[Route('/api/logout', name: 'app_logout', methods: ['POST', 'GET'])]
    public function logout()
    {
        // controller can be blank: it will never be called!
        throw new \Exception('Don\'t forget to activate logout in security.yaml');
    }
}

