<?php
namespace App\Controllers\Admin;

use App\Controllers\Controller as Controller;
use Slim\Http\Request;
use App\Services\Admin\PostService;
use App\Common\UserSession;


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
        $userId = UserSession::getSessionUserid();
        $posts = [];
        
        try {
            $posts = $this->postService->getPostsByUserId($userId);
        } catch (Exception $e) {
            $e->getMessage($e);
        }
        
        $this->app->render('admin/posts.twig', ['posts' => $posts]);
    } 
    
    public function postForm()
    {
         $this->app->render('admin/postForm.twig');
    }
    
    public function create(Request $request)
    {
        $title = $request->params('title');
        $content = $request->params('content');
        
        $userId = UserSession::getSessionUserid();
        $this->postService->postPrepare($userId, $title, $content);
        $this->app->redirect('/blog/public/posts');
    }
}
