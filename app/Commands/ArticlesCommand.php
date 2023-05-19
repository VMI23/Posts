<?php

declare(strict_types=1);

namespace Blog\Commands;

use Blog\Services\Articles\IndexArticleService;

class ArticlesCommand extends Commands
{
    public function execute($parameters = null): array
    {
        $articles = (new IndexArticleService())->execute();
        return $articles;
    }
}