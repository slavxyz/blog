<?php
namespace App\Controllers\Admin;

use App\Controllers\Controller as Controller;
use App\Models\User;
use App\Models\Auth;
use Slim\Http\Request;

class IndexController extends Controller
{
    
    public function index()
    {
        $auth = new Auth(new User());
        if($auth->isSessionExpired()){
            $this->app->redirect('login');
        }
        
        $this->app->render('admin/admin.twig', ['app' => 'Welcome to Admin Panel']);
    }
    
    public function login()
    {
        $this->app->render('admin/login.twig', ['app' => 'Welcome to login']);
    }
    
}
