<?php



$app->post('/auth', function () use ($app) {
       $auth = new  App\Controllers\Auth\AuthController();
       return $auth->index($app->request());
});

$app->get('/login', 'App\Controllers\Admin\IndexController:login');
$app->get('/admin', 'App\Controllers\Admin\IndexController:index');


$user = new App\Models\User();
$auth = new App\Models\Auth($user);

$userRepo = new App\Repositories\Admin\UserRepository($user);
$userSrv = new App\Services\Admin\UserService($userRepo);

$app->get('/users', function() use ($app, $auth, $userSrv){
    
        if($auth->isSessionExpired()){
            $app->redirect('login');
        }
        
        $users = new App\Controllers\Admin\UsersController($userSrv);
        return $users->index();
});

$app->get('/user', function() use ($app, $auth, $userSrv){
    
        if($auth->isSessionExpired()){
            $app->redirect('login');
        }
        
        $userCreate = new App\Controllers\Admin\UsersController($userSrv);
        return $userCreate->userForm();
});

$app->post('/user', function() use ($app, $auth, $userSrv)
{
    
        if($auth->isSessionExpired()){
            $app->redirect('login');
        }
        
        $userCreate = new App\Controllers\Admin\UsersController($userSrv);
        return $userCreate->create($app->request());
});

$post = new App\Models\Posts();
$postRepo = new App\Repositories\Admin\PostRepository($post);
$postSrv = new App\Services\Admin\PostService($postRepo);

$app->get('/postform', function() use ($app, $auth, $postSrv){
    
        if($auth->isSessionExpired()){
            $app->redirect('login');
        }
        
        $form = new App\Controllers\Admin\PostsController($postSrv);
        return $form->postForm();
});

$app->get('/posts', function() use ($app, $auth, $postSrv){
        
        if($auth->isSessionExpired()){
            $app->redirect('login');
        }
        
        $posts = new App\Controllers\Admin\PostsController($postSrv);
        return $posts->index();
});

$app->post('/post', function() use ($app, $auth, $postSrv)
{
    
        if($auth->isSessionExpired()){
            $app->redirect('login');
        }
        
        $postCreate = new App\Controllers\Admin\PostsController($postSrv);
        return $postCreate->create($app->request());
});


$app->get('/', function() use ($app, $postSrv){
    $posts = new App\Controllers\IndexController($postSrv);
        return $posts->index();
});
