<?php
namespace App\Services\Admin;
use App\Repositories\Admin\UserRepository;

class UserService {
    
    private $userRepository;
    
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    
    public function getUsers() : array
    {
        return $this->userRepository->userslist();
    }
    
    public function prepareUser(string $username, string $email, string $role, string $password): void
    {
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        
        if(!$this->verifyEmail($email)){
            throw new Exeption("Email is not valid");
        }
        
        $this->userRepository->createUser($username, $email, $role, $password);
    }
    
    public function verifyEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}
