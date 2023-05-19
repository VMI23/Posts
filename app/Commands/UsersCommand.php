<?php

declare(strict_types=1);

namespace Blog\Commands;

use Blog\Services\User\IndexUsersService;

class UsersCommand extends Commands
{
    public function execute($parameters = null): array
    {
        $users = (new IndexUsersService())->execute();
        return $users;
    }
}