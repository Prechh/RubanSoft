<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Repository\CommandeRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommandeController extends AbstractController
{
    #[Route('/commande', name: 'app_commande')]
    public function index(CommandeRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {
        $commandes = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1), /* page number */
            10
        );

        return $this->render('commande/commande.html.twig', [
            'commandes' => $commandes,
        ]);
    }
}
