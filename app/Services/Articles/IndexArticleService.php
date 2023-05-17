<?php

declare(strict_types=1);

namespace Blog\Services\Articles;

use Blog\PlaceholderClient;

class IndexArticleService
{
    private PlaceholderClient $client;

    public function __construct()
    {
        $this->client = new PlaceholderClient();
    }

    public function execute(): array
    {
        return $this->client->getAllArticles();
    }
}