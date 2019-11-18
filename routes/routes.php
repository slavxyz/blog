<?php

$app->get('/', 'App\Controllers\IndexController:index');

$app->post('/auth', function () use ($app) {
       $auth = new  App\Controllers\Auth\AuthController();
       return $auth->index($app->request());

});

$app->get('/login', 'App\Controllers\Admin\IndexController:login');
$app->get('/admin', 'App\Controllers\Admin\IndexController:index');

$user = new App\Models\User();

$app->get('/posts', function() use ($app, $user){
        
        if($user->isSessionExpired()){
            $app->redirect('login');
        }
        
        $posts = new App\Controllers\Admin\PostsController();
        return $posts->index();
});

$userRepo = new App\Repositories\Admin\UserRepository($user);
$userSrv = new App\Services\Admin\UserService($userRepo);

$app->get('/users', function() use ($app, $user, $userSrv){
    
        if($user->isSessionExpired()){
            $app->redirect('login');
        }
        
        
        $users = new App\Controllers\Admin\UsersController($userSrv);
        return $users->index();
});

$app->post('/user', function() use ($app, $user, $userSrv){
    
        if($user->isSessionExpired()){
            $app->redirect('login');
        }
        
        $userCreate = new App\Controllers\Admin\UsersController($userSrv);
        return $userCreate->create($app->request());
});
