<?php
namespace App\Controllers\Auth;
use App\Controllers\Controller as Controller;
use App\Models\User;

class AuthController extends Controller{
    
    public function Index(){

        $user = new User();
        $username = "Matahari";
        $password = "123456";
        
        $user->authUser($username, $password);
        
        var_dump($_SESSION);
        exit;
    }
}
