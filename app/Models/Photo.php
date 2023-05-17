<?php

declare(strict_types=1);

namespace Blog\Models;

class Photo
{
    private int $albumId;
    private int $id;
    private string $title;
    private string $url;
    private string $thumbnailUrl;

    public function __construct(int $albumId, int $id, string $title, string $url, string $thumbnailUrl)
    {
        $this->albumId = $albumId;
        $this->id = $id;
        $this->title = $title;
        $this->url = $url;
        $this->thumbnailUrl = $thumbnailUrl;
    }

    public function getAlbumId(): int
    {
        return $this->albumId;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getThumbnailUrl(): string
    {
        return $this->thumbnailUrl;
    }
}