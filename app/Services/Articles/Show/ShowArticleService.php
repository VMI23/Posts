<?php

declare(strict_types=1);

namespace Blog\Services\Articles\Show;

use Blog\Exceptions\ArticleNotFoundException;
use Blog\PlaceholderClient;

class ShowArticleService
{
    private PlaceholderClient $client;

    public function __construct()
    {
        $this->client = new PlaceholderClient();
    }

    public function execute(ShowArticleRequest $request): ShowArticleResponse
    {
        $article = $this->client->getArticleById($request->getId());
        $comments = $this->client->getCommentsByArticleId($request->getId());

        if ($article === null) {
            throw new ArticleNotFoundException("Article with ID {$request->getId()} not found");
        }

        return new ShowArticleResponse($article, $comments);
    }
}