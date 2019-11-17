<?php

$app->get('/', 'App\Controllers\IndexController:index');

$app->post('/auth', function () use ($app) {
       $auth = new  App\Controllers\Auth\AuthController();
       return $auth->index($app->request());

});

$app->get('/login', 'App\Controllers\Admin\IndexController:login');
$app->get('/admin', 'App\Controllers\Admin\IndexController:index');

$app->get('/posts', function() use ($app){
        $user = new App\Models\User();
        
        if($user->isSessionExpired()){
            $app->redirect('login');
        }
        
        $posts = new App\Controllers\Admin\PostsController();
        return $posts->index();
});
