<?php

declare(strict_types=1);

namespace Blog\Models;

class Article
{
    private User $user;
    private int $id;
    private string $title;
    private string $body;
    private array $comments;

    public function __construct(User $user, int $id, string $title, string $body, array $comments = [])
    {
        $this->user = $user;
        $this->id = $id;
        $this->title = $title;
        $this->body = $body;
        $this->comments = $comments;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getComments(): array
    {
        return $this->comments;
    }
}