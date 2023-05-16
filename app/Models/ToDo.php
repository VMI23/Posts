<?php

namespace Blog\models;

class ToDo
{

    private int $userId;
    private int $id;
    private string $title;
    private bool $completed;

    public function __construct(int $userId, int $id, string $title, bool $completed)
    {
        $this->userId = $userId;
        $this->id = $id;
        $this->title = $title;
        $this->completed = $completed;
    }


    public function getUserId(): int
    {
        return $this->userId;
    }


    public function getId(): int
    {
        return $this->id;
    }


    public function getTitle(): string
    {
        return $this->title;
    }


    public function isCompleted(): bool
    {
        return $this->completed;
    }

}