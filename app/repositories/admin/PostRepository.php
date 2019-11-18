<?php
namespace App\Repositories\Admin;
use App\Models\Posts;

class PostRepository 
{
    private $post;
    
    public function __construct(Posts $post)
    {
        $this->post = $post;
    }

    public function insertPost($user_id, $title, $content): void
    {
        try {
            $this->post->create([$user_id, $title, $content]);
        } catch (Exception $e){
            echo $e->getMessage();
        }
    }
    public function postsListByUserId(int $userId) : array
    {
        try {
           return $this->post->select()->where('user_id', '=', $userId)->fetchAll();
        } catch (Exception $e){
            echo $e->getMessage();
        }   
    }
    
    public function postslist() : array 
    {
        try {
            return $this->post->select()->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        
                
    }
    
}
