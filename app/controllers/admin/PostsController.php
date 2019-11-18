<?php
namespace App\Controllers\Admin;

use App\Controllers\Controller as Controller;
use Slim\Http\Request;
use App\Services\Admin\PostService;


class PostsController extends Controller
{
    private $postService; 
    
    public function __construct(PostService $postService)
    {
        parent::__construct();
        $this->postService = $postService;
    }
    
    public function index()
    {
        $this->app->render('admin/posts.twig');
    } 
    
    public function postForm()
    {
         $this->app->render('admin/postForm.twig');
    }
    
    public function create(Request $request)
    {
        $title = $request->params('title');
        $content = $request->params('content');
        
        $user_id = $_SESSION['auth_user_id'];
        
      
        $this->postService->postPrepare($user_id, $title, $content);
        
         $this->app->redirect('/blog/public/posts');
    }
}
