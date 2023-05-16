<?php

namespace Blog\controllers;

use Blog\Core\TwigView;
use Blog\PlaceholderClient;

class Controller
{
    public function allPosts(): TwigView
    {
        $posts = new PlaceholderClient();
        $articles = $posts->getAllPosts();

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


        return new TwigView('base', $params);
    }

    public function post($vars): TwigView

    {
        $id = $vars['id'] ?? 1;
        $posts = new PlaceholderClient();
        $article = $posts->getPostById($id);

        $comments = $posts->getCommentsByid($article->getId());

        return new TwigView('post', ['article' => $article, 'comments' => $comments]);
    }

    public function user($vars): TwigView
    {
        $id = $vars['id'];
        $users = new PlaceholderClient();
        $author = $users->getAuthorById($id);

        $albums = new PlaceholderClient();
        $albums = $albums->getAlbumsById($id);

        $posts = new PlaceholderClient();
        $posts = $posts->getPostsByUserId($id);

        $todos = new PlaceholderClient();
        $todos = $todos->getTodosByUserId($id);


        return new TwigView('user', [
            'user' => $author,
            'albums' => $albums,
            'posts' => $posts,
            'todos' => $todos
        ]);
    }

    public function album(): TwigView
    {
        return new TwigView('album', []);
    }


}