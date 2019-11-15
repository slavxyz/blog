<?php
namespace App\Controllers\Admin;

use App\Controllers\Controller as Controller;
use App\Models\User;

class IndexController extends Controller {
    
    public function index(){
        $this->app->render('admin/admin.twig', ['app' => 'Welcome to Admin Panel']);
    }
    
}
