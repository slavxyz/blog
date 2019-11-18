<?php
namespace App\Controllers\Admin;
use App\Controllers\Controller as Controller;
use Slim\Http\Request;
use App\Services\Admin\UserService;

class UsersController extends Controller
{
    private $userService;
    
    public function __construct(UserService $userService)
    {   
        parent::__construct();
        $this->userService = $userService;
        
    }
    
    public function index()
    {
        $users = $this->userService->getUsers();
        $this->app->render('admin/users.twig',['users' => $users]);
    }
    
    public function userForm()
    {
        $this->app->render('admin/user.twig');
    }
    
    public function create(Request $request)
    {
        $username = $request->params('username');
        $email = $request->params('email');
        $role = $request->params('role');
        $password = $request->params('password');
        
        $this->userService->prepareUser($username, $email, $role, $password);
        
         $this->app->redirect('/blog/public/users');
    }
}
