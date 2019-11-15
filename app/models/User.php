<?php

namespace App\Models;

use App\Models\Model;

class User extends Model {

    const SESSION_LOGGED_IN = 'auth_logged_in';
    const SESSION_USER_ID = 'auth_user_id';
    const SESSION_USERNAME = 'auth_username';
    const SESSION_RESYNC = 'auth_resync';

    protected $table = 'users';
    protected $fields = [
        'name',
        'email',
        'password',
    ];
    private $name;
    private $email;
    private $password;

    public function table() {
        return $this->table;
    }

    public function fields() {
        return $this->fields;
    }

    public function length() {
        return count($this->fields);
    }

    public function login() {
        
    }

    public function authUser($username = null, $password = null) {

        $userData = [];

        if ($username !== null) {

            $username = trim($username);
            $userData = $this->getUserByUsername($username);
        } else {
            throw new \Exception("Username required");
        }
        
        

        if ($userData) {
            $userData []= $this->getPasswordByUsername($userData['name']);
        } else {
            throw new \Exception("Username does not exists");
        }
        
        $password = self::validatePassword($password);
        
        if (password_verify($password, $userData['password'])) {
            $this->loginSuccessfull($userData['id'], $userData['name']);
        } else {
            throw new \Exception("Password didn`t match");
        }
    }

    public function loginSuccessfull($id, $username) {
        $_SESSION[self::SESSION_LOGGED_IN] = true;
        $_SESSION[self::SESSION_USER_ID] = $id;
        $_SESSION[self::SESSION_USERNAME] = $username;
        $_SESSION[self::SESSION_RESYNC] = time();
    }

    protected static function validatePassword($password) {
        if (empty($password)) {
            throw new InvalidPasswordException();
        }
        $password = \trim($password);
        if (\strlen($password) < 1) {
            throw new InvalidPasswordException();
        }
        return $password;
    }

    public function getUserByUsername($username) {

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

    public function getPasswordByUsername($username) {
        try {
            $password = $this->select(['password'])
                    ->where("name", "=", $username)
                    ->limit(1)
                    ->fetchOne();

            return !empty($password) ? $password : null;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    
    public function logout(){
        
    }

    public function isSessionExpired() {
        
    }

}
