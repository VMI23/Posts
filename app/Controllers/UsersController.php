<?php

declare(strict_types=1);

namespace Blog\Controllers;

use Blog\Core\TwigView;
use Blog\Exceptions\UserNotFoundException;
use Blog\Services\User\Show\ShowUserRequest;
use Blog\Services\User\Show\ShowUserService;

class UsersController
{
    public function show($vars): TwigView
    {
        try {
            $id = $vars['id'];

            $response = (new ShowUserService())->execute(new ShowUserRequest((int)$id));

            return new TwigView('user', [
                'user' => $response->getUser(),
                'albums' => $response->getAlbums(),
                'posts' => $response->getPosts(),
                'todos' => $response->getTodos(),
            ]);
        } catch (UserNotFoundException $e) {
            return new TwigView('404', []);
        }
    }
}