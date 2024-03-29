<?php

namespace App\Controller;

use Knp\Snappy\Pdf;
use App\Entity\Article;
use App\Entity\Commande;
use App\Form\CommandeType;
use App\Form\CommandeAdminType;
use Symfony\Component\Mime\Email;
use App\Event\CommandeCreatedEvent;
use App\Form\CommandeLogistiqueType;
use Symfony\Component\Mailer\Mailer;
use App\Form\CommandeFacturationType;
use App\Repository\CommandeRepository;
use Symfony\Component\Mailer\Transport;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class CommandeController extends AbstractController
{
    #[Route('/commande', name: 'app_commande_view')]
    #[IsGranted('ROLE_PROD')]
    public function index(CommandeRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {
        $commandes = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1), /* page number */
            20
        );

        return $this->render('commande/commande.html.twig', [
            'commandes' => $commandes,
        ]);
    }

    #[Route('/commande/new', name: 'app_commande_new',  methods: ['GET', 'POST'])]
    public function new(MailerInterface $mailer, Request $request, EntityManagerInterface $manager,  EventDispatcherInterface $eventDispatcher): Response
    {
        $commande = new Commande();
        $form = $this->createForm(CommandeType::class, $commande);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $commande = $form->getData();

            $manager->persist($commande);
            $manager->flush();

            $email = (new Email())
                ->from('RubanSoft@RubanSoft.com')
                ->to('ServiceProduction@RubanSoft.com')
                ->subject('Une nouvelle commande est arrivée !')
                ->html("<h1> Une nouvelle commande est arrivée ! </h1>" . "<p> Email : ServiceFacturation@RubanSoft.com  </p>");

            $transport = Transport::fromDsn($_ENV['MAILER_DSN']);
            $mailer = new Mailer($transport);

            $mailer->send($email);


            $this->addFlash(
                'success',
                'Votre article à été commandé avec succès !'
            );

            $event = new CommandeCreatedEvent($commande);
            $eventDispatcher->dispatch($event, 'commande.created');

            return $this->redirectToRoute('app_article_user');
        }

        return $this->render('commande/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/commande/edit/{id}', 'app_commande_edit',  methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_PROD')]
    public function edit(Commande $commande, Request $request, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(CommandeAdminType::class, $commande);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $commande = $form->getData();

            $manager->persist($commande);
            $manager->flush();


            $email = (new Email())
                ->from('RubanSoft@RubanSoft.com')
                ->to('ServiceLogistique@RubanSoft.com')
                ->subject('Une nouvelle commande est arrivée !')
                ->html("<h1> Une nouvelle commande est arrivée ! </h1>" . "<p> Email : ServiceFacturation@RubanSoft.com  </p>");

            $transport = Transport::fromDsn($_ENV['MAILER_DSN']);
            $mailer = new Mailer($transport);

            $mailer->send($email);


            $this->addFlash(
                'success',
                'La commande à été modifié avec succès !'
            );

            return $this->redirectToRoute('app_commande');
        }

        return $this->render('commande/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/commande/logistique', name: 'app_commande_logistique')]
    #[IsGranted('ROLE_LOGISTIQUE')]
    public function show(CommandeRepository $repositorys, PaginatorInterface $paginators, Request $requests): Response
    {
        $commandes = $paginators->paginate(
            $repositorys->findAllbyId(),
            $requests->query->getInt('page', 1), /* page number */
            20
        );

        return $this->render('commande/logistique.html.twig', [
            'commandes' => $commandes,
        ]);
    }

    #[Route('/commande/logistique/edit/{id}', 'app_commande_logistique_edit',  methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_LOGISTIQUE')]
    public function showEdit(Commande $commande, Request $request, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(CommandeLogistiqueType::class, $commande);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $commande = $form->getData();

            $manager->persist($commande);
            $manager->flush();

            $email = (new Email())
                ->from('RubanSoft@RubanSoft.com')
                ->to('ServiceFacturation@RubanSoft.com')
                ->subject('Une nouvelle commande est arrivée !')
                ->html("<h1> Une nouvelle commande est arrivée ! </h1>" . "<p> Email : ServiceFacturation@RubanSoft.com  </p>");

            $transport = Transport::fromDsn($_ENV['MAILER_DSN']);
            $mailer = new Mailer($transport);

            $mailer->send($email);


            $this->addFlash(
                'success',
                'La commande à été modifié avec succès !'
            );

            return $this->redirectToRoute('app_commande_logistique');
        }

        return $this->render('commande/logistiqueEdit.html.twig', [
            'form' => $form->createView()
        ]);
    }


    #[Route('/commande/facturation', name: 'app_commande_facturation')]
    #[IsGranted('ROLE_FACTURATION')]
    public function facturation(CommandeRepository $repositorys, PaginatorInterface $paginators, Request $requests): Response
    {
        $commandes = $paginators->paginate(
            $repositorys->findAllbyId(),
            $requests->query->getInt('page', 1), /* page number */
            20
        );

        return $this->render('commande/facturation.html.twig', [
            'commandes' => $commandes,
        ]);
    }

    #[Route('/commande/facturation/edit/{id}', 'app_commande_facturation_edit',  methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_FACTURATION')]
    public function facturationEdit(Commande $commande, Request $request, EntityManagerInterface $manager, MailerInterface $mailer): Response
    {
        $form = $this->createForm(CommandeFacturationType::class, $commande);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $commande = $form->getData();

            $manager->persist($commande);
            $manager->flush();

            $email = (new Email())
                ->from('ServiceFacturation@RubanSoft.com')
                ->to($commande->getEmail())
                ->subject('Votre commande est en route !')
                ->html("<h1> Votre commmande est en route ! </h1>" . "<p> Email : ServiceFacturation@RubanSoft.com  </p>" . "<p> Objet : Votre commande est en route !</p>" . "<p> Message :  Bonjour {$commande->getName()}, votre commande numéros {$commande->getId()} est en route ! </p> <p> Récapitulatif de votre commande : </p> <p> Articles : {$commande->getArticles()} </p> <p> Quantitée : {$commande->getQuantity()} </p> <p> Prix : {$commande->getPrice()} </p> <p> Date de commande : {$commande->getDateDelivery()} </p>  <p> Poids total : {$commande->getWeight()} </p> <p> Numéros de suivit de la commande : {$commande->getTrackingNumber()} </p> <p> Date départ commande : {$commande->getDateStartDelivery()} </p> <p> Etat de la livraison : {$commande->getStateDeliveryType()} </p>  <p> En éspérant vous revoir bientôt, Cordialment </p> <p> L'équipe de RubanSoft </p>");

            $transport = Transport::fromDsn($_ENV['MAILER_DSN']);
            $mailer = new Mailer($transport);

            $mailer->send($email);

            $this->addFlash(
                'success',
                'Mail envoyé avec succès !'
            );

            return $this->redirectToRoute('app_commande_facturation');
        }

        return $this->render('commande/facturationEdit.html.twig', [
            'form' => $form->createView()
        ]);
    }



    #[Route('/pdf/{id}', name: 'commande.pdf')]
    #[IsGranted('ROLE_FACTURATION')]

    public function generatePdf(Pdf $pdf, Commande $commande)
    {
        $html = $this->renderView('commande/factureTemplate.html.twig', [
            'commande' => $commande,
            "title" => "commande {$commande->getId()}",
        ]);

        $filename =  "commande {$commande->getId()}";

        return new Response(
            $pdf->getOutputFromHtml($html),
            200,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="' . $filename . '".pdf"'
            ]
        );
    }
}
