<?php

declare(strict_types=1);

namespace Blog\Commands;

use Blog\Services\Articles\Show\ShowArticleRequest;
use Blog\Services\Articles\Show\ShowArticleResponse;
use Blog\Services\Articles\Show\ShowArticleService;

class ArticleCommand extends Commands
{
    public function execute($parameters = null) : ShowArticleResponse
    {
        $article = (new ShowArticleService())->execute(new ShowArticleRequest((int)$parameters));
        return $article;
    }
}