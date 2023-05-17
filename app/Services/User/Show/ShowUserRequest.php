<?php

declare(strict_types=1);

namespace Blog\Services\User\Show;

class ShowUserRequest
{
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }
}