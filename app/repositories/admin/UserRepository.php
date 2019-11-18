<?php
namespace App\Repositories\Admin;
use App\Models\User;

class UserRepository {
    
    private $user;
    
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    
    public function createUser(string $username, string $email, string $role, string $password): void
    {
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        
        $this->user->create([$username, $email, $role, $passwordHash]);
    }
    
    public function userslist() : array 
    {
        try{
            return $this->user->select()->fetchAll();
        } catch (Exception $e){
            echo $e->getMessage();
        }
        
                
    }
}
