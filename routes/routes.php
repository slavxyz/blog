<?php

$app->get('/', 'App\Controllers\IndexController:index');
$app->get('/', 'App\Controllers\IndexController:index');
$app->post('/auth', function () use ($app) {
       $auth = new  App\Controllers\Auth\AuthController();
       
       return $auth->index($app->request());

});


$app->get('/login', 'App\Controllers\Admin\IndexController:login');
$app->get('/admin', 'App\Controllers\Admin\IndexController:index');

$app->get('/posts', 'App\Controllers\Admin\PostsController:index');




