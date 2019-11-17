<?php

namespace App\Controllers\Auth;

use App\Controllers\Controller as Controller;

use App\Models\User;
use Slim\Http\Request as Request;

class AuthController extends Controller
{
    
    public function index(Request $request)
    {
        $username = $request->params('user');
        $password = $request->params('password');
        
        if(empty($username) || empty($password))
            $this->app->redirect('login');
        
        $user = new User();
        if($user->authUser($username, $password)){
            $this->app->redirect('posts');
        }
        
        $this->app->redirect('login');
    }   
}