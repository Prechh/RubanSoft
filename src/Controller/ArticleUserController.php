<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleUserController extends AbstractController
{
    #[Route('/article/user', name: 'app_article_user')]
    public function index(ArticleRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {
        $articles = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1), /*page number*/
            16
        );

        return $this->render('article_user/articleUser.html.twig', [
            'articles' => $articles,
        ]);
    }

    #[Route('/article/user/show/{id}', 'app_article_user_show',  methods: ['GET'])]
    public function show(Article $article): Response
    {
        return $this->render('article_user/show.html.twig', [
            'article' => $article
        ]);
    }
}
