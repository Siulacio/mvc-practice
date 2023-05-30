<?php

namespace Blog\Controllers;

use Blog\Interfaces\IArticle;
use Blog\Models\Article;
use Twig\Environment;

class HomeController
{
    protected IArticle $articleRepository;
    protected Environment $twig;

    public function __construct(IArticle $articleRepository, Environment $twig)
    {
        $this->articleRepository = $articleRepository;
        $this->twig = $twig;
    }

    public function index()
    {
        echo 'Hola desde el HomeController';

    }

    public function articulos()
    {
        echo $this->twig->render('home.twig', [
            'articles' => $this->articleRepository->getArticles(),
        ]);
    }

    public function articulo(int $id)
    {
        echo $this->twig->render('article.twig', [
            'article' => $this->articleRepository->getArticle($id),
        ]);
    }
}
