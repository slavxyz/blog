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
        try{
            $users = $this->userService->getUsers();
        } catch(Exception $e) {
            echo $e->getMessage();
        }
        
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
        
        try{
            $this->userService->prepareUser($username, $email, $role, $password);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        
         $this->app->redirect('/blog/public/users');
    }
}
