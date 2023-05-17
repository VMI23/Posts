<?php

declare(strict_types=1);

namespace Blog\Services\Articles\Show;

use Blog\Models\Article;

class ShowArticleResponse
{
    private Article $article;
    private array $comments;

    public function __construct(Article $article, array $comments)
    {
        $this->article = $article;
        $this->comments = $comments;
    }

    public function getArticle(): Article
    {
        return $this->article;
    }

    public function getComments(): array
    {
        return $this->comments;
    }
}