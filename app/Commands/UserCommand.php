<?php

declare(strict_types=1);

namespace Blog\Commands;

use Blog\Services\User\Show\ShowUserRequest;
use Blog\Services\User\Show\ShowUserResponse;
use Blog\Services\User\Show\ShowUserService;

class UserCommand extends Commands
{
    public function execute($parameters = null) : ShowUserResponse
    {
     $user = (new ShowUserService())->execute(new ShowUserRequest((int)$parameters));
     return $user;
    }
}