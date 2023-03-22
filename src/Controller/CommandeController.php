<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Form\CommandeType;
use App\Repository\CommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
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

    #[Route('/commande/new', name: 'app_commande_new',  methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        $commande = new Commande();
        $form = $this->createForm(CommandeType::class, $commande);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $commande = $form->getData();

            $manager->persist($commande);
            $manager->flush();

            $this->addFlash(
                'success',
                'Le locataire à été ajoutée avec succès !'
            );

            return $this->redirectToRoute('app_commande_new');
        }

        return $this->render('commande/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
