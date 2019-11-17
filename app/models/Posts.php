<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;
use App\Models\Model;

class Posts extends Model
{
    protected $table = 'posts';
    protected $fields = [
        'user_id',
        'title',
        'posts',
    ];

    public function table(): string
    {
        return $this->table;
    }

    public function fields(): string
    {
        return $this->fields;
    }

    public function length(): int
    {
        return count($this->fields);
    }
}
