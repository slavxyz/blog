<?php
namespace App\Controllers;
use App\Controllers\Controller as Controller;
use App\Models\User;

class IndexController extends Controller {
    
    public function index()
    {
        $this->app->render('app.twig', ['app' => 'Welcome to Blog']);
    }
}
