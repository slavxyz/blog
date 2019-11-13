<?php
namespace App\Controllers;

class IndexController {
    
    protected $app;
    
    public function __construct(){
         $this->app = \Slim\Slim::getInstance();
    }
    
    public function index(){
         $this->app->render('app.twig', ['app' => 'Welcome to Blog']);
    }
}
