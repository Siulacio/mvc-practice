<?php

namespace Blog\Models;

class Article
{
    public function __construct(
        protected int $id,
        protected string $title,
        protected string $content
    ) {}

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

}
