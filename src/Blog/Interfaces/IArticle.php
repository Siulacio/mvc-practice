<?php

namespace Blog\Interfaces;

interface IArticle
{
    public function getArticles(): array;

    public function getArticle(int $id);
}
