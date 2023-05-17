<?php

declare(strict_types=1);

namespace Blog\Services\User\Show;

use Blog\models\User;

class ShowUserResponse
{
    private User $user;
    private array $albums;
    private array $posts;
    private array $todos;

    public function __construct(User $user, array $albums, array $posts, array $todos)
    {
        $this->user = $user;
        $this->albums = $albums;
        $this->posts = $posts;
        $this->todos = $todos;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getAlbums(): array
    {
        return $this->albums;
    }

    public function getPosts(): array
    {
        return $this->posts;
    }

    public function getTodos(): array
    {
        return $this->todos;
    }
}