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

    public function insertPost($user_id, $title, $content)
    {
        $this->post->create([$user_id, $title, $content]);
    }
    
}
