<?php

/** @var \League\Route\Router $router */

use App\Controllers\SiteController;

$router->get('/', [SiteController::class, 'index']);

$router->get('/create', [SiteController::class, 'create']);
$router->post('/create', [SiteController::class, 'store']);

$router->get('/book/edit/{id}', [SiteController::class, 'edit']);
$router->post('/book/update/{id}', [SiteController::class, 'update']);

$router->post('book/delete/{id}', [SiteController::class, 'destroy']);