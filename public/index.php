<?php

declare(strict_types=1);

use Blog\Core\Renderer;
use Blog\Core\Router;

require '../vendor/autoload.php';
$routes = require_once __DIR__ . '/../app/routes.php';
$response = Router::response($routes);
$renderer = new Renderer(__DIR__ . '/../app/Views');

echo $renderer->render($response);

