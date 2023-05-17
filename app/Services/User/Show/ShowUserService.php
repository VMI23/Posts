<?php

declare(strict_types=1);

namespace Blog\Services\User\Show;

use Blog\Exceptions\UserNotFoundException;
use Blog\PlaceholderClient;

class ShowUserService
{
    private PlaceholderClient $client;

    public function __construct()
    {
        $this->client = new PlaceholderClient();
    }

    public function execute(ShowUserRequest $request): ShowUserResponse
    {
        $user = $this->client->getUserById($request->getId());
        $albums = $this->client->getAlbumsById($request->getId());
        $posts = $this->client->getArticlesByUserId($request->getId());
        $todos = $this->client->getTodosByUserId($request->getId());

        if (!$user) {
            throw new UserNotFoundException("User with ID " . $request->getId() . " not found");
        }

        return new ShowUserResponse($user, $albums, $posts, $todos);
    }
}