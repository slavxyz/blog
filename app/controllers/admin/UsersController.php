<?php
namespace App\Controllers\Admin;
use App\Controllers\Controller as Controller;
use Slim\Http\Request;

class UsersController extends Controller
{
    
    public function index()
    {
        $this->app->render('admin/user.twig');
    }
    
    public function create(Request $request)
    {
        $username = $request->params('username');
        $email = $request->params('username');
        $role = $request->params('role');
        $password = $request->params('password');
    }
}
