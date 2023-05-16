<?php

declare(strict_types=1);

namespace Blog;

use Blog\Controllers\Controller;

return [
    ['GET', '/', [Controller::class, 'allPosts']],
    ['GET', '/post/{id}', [Controller::class, 'post']],
    ['GET', '/user/{id}', [Controller::class, 'user']],
    ['GET', '/album', [Controller::class, 'album']],

];