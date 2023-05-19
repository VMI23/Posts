<?php

declare(strict_types=1);

use Blog\Commands\ArticleCommand;
use Blog\Commands\ArticlesCommand;
use Blog\Commands\UserCommand;
use Blog\Commands\UsersCommand;


require 'vendor/autoload.php';

unset($argv[0]);

$command = $argv[1] ?? null;
$parameter = $argv[2] ?? null;
$subCommand = $argv[3] ?? null;


switch ($command) {
    case 'users':

        $users = (new UsersCommand())->execute();

        if ($users) {
            foreach ($users as $user) {
                echo "User ID: " . $user->getId() . "\n";
                echo "Name: " . $user->getName() . "\n";
                echo "Email: " . $user->getEmail() . "\n";
                echo "\n";
            }
        }
        break;

    case 'user':

        if ($parameter) {
            $user = (new UserCommand())->execute($parameter);

            if ($subCommand === null) {
                echo "-----------------------" . PHP_EOL;
                echo "User ID: " . $user->getUser()->getId() . PHP_EOL;
                echo "Name: " . $user->getUser()->getName() . PHP_EOL;
                echo "Email: " . $user->getUser()->getEmail() . PHP_EOL;
                echo "Article count: " . count($user->getArticles()) . PHP_EOL;
                echo "-----------------------" . PHP_EOL;
            } elseif ($subCommand == 'albums') {
                foreach ($user->getAlbums() as $album) {
                    echo "-----------------------" . PHP_EOL;
                    echo "Album ID: " . $album->getId() . PHP_EOL;
                    echo "Title: " . $album->getTitle() . PHP_EOL;
                    echo "-----------------------" . PHP_EOL;
                }
            } elseif ($subCommand == 'articles') {
                foreach ($user->getArticles() as $article) {
                    echo "-----------------------" . PHP_EOL;
                    echo "Article ID: " . $article->getId() . PHP_EOL;
                    echo "Title: " . $article->getTitle() . PHP_EOL;
                    echo "-----------------------" . PHP_EOL;
                }
            } elseif ($subCommand == 'todos') {
                foreach ($user->getTodos() as $todo) {
                    echo "-----------------------" . PHP_EOL;
                    echo "Todo ID: " . $todo->getId() . PHP_EOL;
                    echo "Title: " . $todo->getTitle() . PHP_EOL;
                    echo "Completed: " . ($todo->isCompleted() ? "true" : "false") . PHP_EOL;
                    echo "-----------------------" . PHP_EOL;
                }
            } else {
                echo "Invalid sub-command. Available sub-commands: articles, albums, todos.\n";
            }
        }
        break;

    case 'articles':
        $articles = (new ArticlesCommand())->execute();

        foreach ($articles as $article) {
            echo "-----------------------" . PHP_EOL;
            echo "Article ID: " . $article->getId() . PHP_EOL;
            echo "Title: " . $article->getTitle() . PHP_EOL;
            echo "Author: " . $article->getUser()->getName() . PHP_EOL;
            echo "-----------------------" . PHP_EOL;
        }
        break;

    case 'article':
        if ($parameter) {
            $article = (new ArticleCommand())->execute($parameter);

            if ($subCommand === null) {
                echo "-----------------------" . PHP_EOL;
                echo "Article ID: " . $article->getArticle()->getId() . PHP_EOL;
                echo "Title: " . $article->getArticle()->getTitle() . PHP_EOL;
                echo "Name: " . $article->getArticle()->getUser()->getName() . PHP_EOL;
                echo "Comments count: " . count($article->getComments()) . PHP_EOL;
                echo "-----------------------" . PHP_EOL;
            } elseif ($subCommand === 'body') {
                echo "-----------------------" . PHP_EOL;
                echo "Article ID: " . $article->getArticle()->getId() . PHP_EOL;
                echo "Body: " . $article->getArticle()->getBody() . PHP_EOL;
                echo "-----------------------" . PHP_EOL;
            } elseif ($subCommand === "comments") {
                foreach ($article->getComments() as $comment) {
                    echo "-----------------------" . PHP_EOL;
                    echo "Comment ID: " . $comment->getId() . PHP_EOL;
                    echo "Name: " . $comment->getName() . PHP_EOL;
                    echo "Email: " . $comment->getEmail() . PHP_EOL;
                    echo "Body: " . $comment->getBody() . PHP_EOL;
                    echo "-----------------------" . PHP_EOL;
                }
            } else {
                echo "Invalid sub-command. Available sub-commands: body, comments.\n";
            }
        }
        break;

    default:
        echo "Command not recognized.\n";
}