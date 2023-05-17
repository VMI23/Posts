<?php

declare(strict_types=1);

namespace Blog\Services\Articles\Show;

class ShowArticleRequest
{
    private int $articleId;

    public function __construct(int $articleId)
    {
        $this->articleId = $articleId;
    }

    public function getId(): int
    {
        return $this->articleId;
    }
}