<?php

declare(strict_types=1);

namespace Blog;

use Blog\Controllers\ArticleController;
use Blog\Controllers\UsersController;

return [
    ['GET', '/', [ArticleController::class, 'index']],
    ['GET', '/post/{id}', [ArticleController::class, 'show']],
    ['GET', '/user/{id}', [UsersController::class, 'show']],

];