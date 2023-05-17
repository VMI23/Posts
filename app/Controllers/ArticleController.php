<?php

declare(strict_types=1);

namespace Blog\Controllers;

use Blog\Core\TwigView;
use Blog\Exceptions\ArticleNotFoundException;
use Blog\Services\Articles\IndexArticleService;
use Blog\Services\Articles\Show\ShowArticleRequest;
use Blog\Services\Articles\Show\ShowArticleService;

class ArticleController
{
    public function index(): TwigView
    {
        $service = new IndexArticleService();
        $articles = $service->execute();

        $totalArticles = count($articles);
        $limit = 100;
        $currentPage = $_GET['page'] ?? 1;
        $numPages = ceil($totalArticles / $limit);

        $params = [
            'articles' => $articles,
            'current_page' => $currentPage,
            'num_pages' => $numPages,
            'limit' => $limit,
        ];

        return new TwigView('posts', $params);
    }

    public function show($vars): TwigView
    {
        try {
            $id = $vars['id'] ?? 1;
            $service = new ShowArticleService();
            $response = $service->execute(new ShowArticleRequest((int)$id));

            return new TwigView('post', [
                'article' => $response->getArticle(),
                'comments' => $response->getComments()
            ]);
        } catch (ArticleNotFoundException $e) {
            return new TwigView('404', []);
        }
    }
}
