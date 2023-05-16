<?php

namespace Blog\models;

class Album
{
    private int $userId;
    private int $id;
    private string $title;

    private array $photos;

    public function __construct(int $userId, int $id, string $title, array $photos = [])
    {
        $this->userId = $userId;
        $this->id = $id;
        $this->title = $title;
        $this->photos = $photos;
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

    public function getPhotos(): array
    {
        return $this->photos;
    }

}