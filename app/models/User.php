<?php

namespace App\Models;

use App\Models\Model;

class User extends Model {

    const SESSION_LOGGED_IN = 'auth_logged_in';
    const SESSION_USER_ID = 'auth_user_id';
    const SESSION_USERNAME = 'auth_username';
    const SESSION_RESYNC = 'auth_resync';
    
    private  $loginTimeDuration = 10; //60 * 5; // 5 minutes 

    protected $table = 'users';
    protected $fields = [
        'name',
        'email',
        'password',
    ];
    private $name;
    private $email;
    private $password;

    public function table(): string {
        return $this->table;
    }

    public function fields(): string {
        return $this->fields;
    }

    public function length(): int {
        return count($this->fields);
    }

    public function login() {
        
    }

    public function authUser(string $username = null,  string $password = null): bool {

        $userData = [];

        if ($username !== null) {

            $username = trim($username);
            $userData = $this->getUserByUsername($username);
        } else {
            throw new \Exception("Username required");
        }

        if ($userData) {
            $userData['password'] = $this->getPasswordByUsername($userData['name']);
        } else {
            throw new \Exception("Username does not exists");
        }
        
        $password = self::validatePassword($password);
        
        if (password_verify($password, $userData['password'])) {
            $this->loginSuccessfull($userData['id'], $userData['name']);
            
            return true;
        } else {
           throw new InvalidPasswordException();
        }
        
        return false;
    }

    public function loginSuccessfull(int $id, string $username) : void 
    {
        $_SESSION[self::SESSION_LOGGED_IN] = true;
        $_SESSION[self::SESSION_USER_ID] = $id;
        $_SESSION[self::SESSION_USERNAME] = $username;
        $_SESSION[self::SESSION_RESYNC] = time();
    }

    protected static function validatePassword(string $password) : string
    {
        if (empty($password)) {
            throw new InvalidPasswordException();
        }
        
        $passwordTrimmed = \trim($password);
        if (\strlen($passwordTrimmed) < 1) {
            throw new InvalidPasswordException();
        }
        return $passwordTrimmed;
    }

    public function getUserByUsername(string $username): array
    {
        try {
            $data = $this->select()
                    ->where('name', "=", $username)
                    ->limit(1)
                    ->fetchOne();

            return !empty($data) ? $data : null;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getPasswordByUsername(string $username): string
    {
        try {
            $data = $this->select(['password'])
                    ->where("name", "=", $username)
                    ->limit(1)
                    ->fetchOne();
            
            return !empty($data['password']) ? $data['password'] : null;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    
    public function logout(): void
    {
        
    }

    public function isSessionExpired() : bool
    {
        if ($_SESSION[self::SESSION_RESYNC]) {
            if (((time() - $_SESSION[self::SESSION_RESYNC]) > $this->loginTimeDuration)) {
               return true;
            }
        }
        return false;
    }

}
