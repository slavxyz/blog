<?php

$app->get('/', 'App\Controllers\IndexController:index');
$app->get('/auth', 'App\Controllers\Auth\AuthController:index');
$app->get('/admin', 'App\Controllers\Admin\IndexController:index');
