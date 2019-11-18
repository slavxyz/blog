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
            $userData['password'] = $this->getPasswordByUsername($userData['username']);
        } else {
            throw new \Exception("Username does not exists");
        }
        
        $passwordValidate = self::validatePassword($password);
        
        if (password_verify($passwordValidate, $userData['password'])) {
            $this->loginSuccessfull($userData['id'], $userData['username'], $userData['role']);
            
            return true;
        } else {
           throw new InvalidPasswordException();
        }
        
        return false;
    }

    public function loginSuccessfull(int $userId, string $username, string $role) : void 
    {
        UserSession::setSessionLoggedIn(true);
        UserSession::setSessionUserid($userId);
        UserSession::setSessionUsername($username);
        UserSession::setSessionRole($role);
        UserSession::setSessionResync(time());
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
                    ->where('username', "=", $username)
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
                    ->where("username", "=", $username)
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
        if (UserSession::getSessionResync()) {
            if (((time() - UserSession::getSessionResync()) > UserSession::getLoginTimeDuration())) {
               return true;
            }
        }
        return false;
    }

}
