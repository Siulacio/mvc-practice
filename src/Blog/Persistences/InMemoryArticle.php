<?php

namespace Blog\Persistences;

use Blog\Interfaces\IArticle;
use Blog\Models\Article;

class InMemoryArticle implements IArticle
{
    protected array $articles;

    public function __construct()
    {
        $this->articles = [
            1 => new Article(1, 'Artículo 1', 'Nuevo contenido artículo 1'),
            2 => new Article(2, 'Artículo 2', 'Nuevo contenido artículo 2'),
        ];
    }

    public function getArticles(): array
    {
        return $this->articles;
    }

    public function getArticle(int $id): Article
    {
        return $this->articles[$id];
    }
}
