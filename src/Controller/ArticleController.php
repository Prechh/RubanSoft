<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Knp\Component\Pager\PaginatorInterface;

class ArticleController extends AbstractController
{
    #[Route('/article', name: 'app_article',  methods: ['GET'])]
    public function index(ArticleRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {
        $articles = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1), /* page number */
            10
        );

        return $this->render('article/article.html.twig', [
            'articles' => $articles
        ]);
    }


    #[Route('/article/new', name: 'app_article_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $article = $form->getData();

            $manager->persist($article);
            $manager->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->render('article/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
