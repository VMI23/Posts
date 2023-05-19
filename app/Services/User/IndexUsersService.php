<?php

declare(strict_types=1);

namespace Blog\Services\User;

use Blog\PlaceholderClient;

class IndexUsersService
{
    private PlaceholderClient $client;

    public function __construct()
    {
        $this->client = new PlaceholderClient();
    }

    public function execute(): array
    {
        return $this->client->getAllUsers();
    }
}