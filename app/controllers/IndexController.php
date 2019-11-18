<?php
namespace App\Controllers;
use App\Controllers\Controller as Controller;
use App\Services\Admin\PostService;



class IndexController extends Controller {
    
    private $postService; 
    
    public function __construct(PostService $postService)
    {
        parent::__construct();
        $this->postService = $postService;
    }
    
    public function index()
    {
        $posts = [];
        try{
            $posts =  $this->postService->getPosts();       
        } catch(Exception $e) {
            $e->getMessage();
        }
        
        $this->app->render('app.twig', ['posts' => $posts]);
    }
    
}
