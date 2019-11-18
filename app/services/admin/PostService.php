<?php
namespace App\Services\Admin;
use App\Repositories\Admin\PostRepository;

class PostService
{
    private $postRepository;
            
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }
    
    public function getPostsByUserId($userId) : array
    {
        return $this->postRepository->postsListByUserId($userId);
    }
    
    public function getPosts() : array
    {
        return $this->postRepository->postslist();
    }
    
    public function postPrepare($user_id, $title, $content)
    {
        $this->postRepository->insertPost($user_id, $title, $content);
    }
}
