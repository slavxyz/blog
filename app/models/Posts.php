<?php

namespace App\Models;
use App\Models\Model;

class Posts extends Model
{
    protected $table = 'posts';
    protected $fields = [
        'user_id',
        'title',
        'body',
    ];

    public function table(): string
    {
        return $this->table;
    }

    public function fields(): array
    {
        return $this->fields;
    }

    public function length(): int
    {
        return count($this->fields);
    }
}
