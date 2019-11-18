<?php

namespace App\Controllers\Auth;

use App\Controllers\Controller as Controller;

use App\Models\Auth;
use App\Models\User;
use App\Common\UserSession;
use Slim\Http\Request as Request;

class AuthController extends Controller
{
    
    public function index(Request $request)
    {
        $username = $request->params('user');
        $password = $request->params('password');
        
        if(empty($username) || empty($password)){
            $this->app->redirect('login');
        }
        
        $auth = new Auth(new User);
        
        if($auth->authUser($username, $password)){
            $role = UserSession::getSessionRole();
            if($role === 'admin'){
                $this->app->redirect('users');
            }else{    
                $this->app->redirect('posts');
            }
        }
        
        $this->app->redirect('login');
    }   
}