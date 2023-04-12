<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login',  methods: ['GET', 'POST'])]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $user = $this->getUser();

        if ($this->isGranted('ROLE_ADMIN', $user)) {
            // Rediriger l'utilisateur vers la page de production
            return $this->redirectToRoute('app_home_admin');
        }
        if ($this->isGranted('ROLE_PROD', $user)) {
            // Rediriger l'utilisateur vers la page de production
            return new RedirectResponse($this->generateUrl('prod_page'));
        }
        if ($this->isGranted('ROLE_LOGISTIQUE', $user)) {
            // Rediriger l'utilisateur vers la page de production
            return new RedirectResponse($this->generateUrl('logistique_page'));
        }
        if ($this->isGranted('ROLE_FACTURATION', $user)) {
            // Rediriger l'utilisateur vers la page de production
            return new RedirectResponse($this->generateUrl('facturation_page'));
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
