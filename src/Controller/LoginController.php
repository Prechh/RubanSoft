<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login',  methods: ['GET', 'POST'])]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('app_homeTEST');
        }
        return $this->render('login/login.html.twig', [
            'error' => $authenticationUtils->getLastAuthenticationError()
        ]);
    }
    #[Route('/logout', 'app_login_logout')]
    public function logout()
    {
        // Nothing to do here..
    }
}
