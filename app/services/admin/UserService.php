<?php
namespace App\Services\Admin;
use App\Repositories\Admin\UserRepository;

class UserService {
    
    private $userRepository;
    
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    
    public function prepareUser(string $username, string $email, string $role, string $password): void
    {
        $this->userRepository->createUser($username, $email, $role, $password);
    }
}
