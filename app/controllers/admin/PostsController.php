<?php
namespace App\Controllers\Admin;

use App\Controllers\Controller as Controller;

class PostsController extends Controller{
    
    public function index(){
        
        $this->app->render('admin/posts.twig');
    } 
}
