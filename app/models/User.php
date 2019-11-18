<?php

namespace App\Models;

use App\Models\Model;
use App\Common\UserSession;

class User extends Model {

    protected $table = 'users';
    protected $fields = [
        'username',
        'email',
        'role',
        'password',
    ];
    private $name;
    private $email;
    private $password;

    public function table(): string {
        return $this->table;
    }

    public function fields(): array {
        return $this->fields;
    }

    public function length(): int {
        return count($this->fields);
    }

    

}
