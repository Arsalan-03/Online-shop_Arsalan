<?php

namespace Service\AuthenticationService;

use Entity\User;
use Repository\UserRepository;

class CookieAuthenticationService
{
    private UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }
    public function check(): bool
    {
        return isset($_COOKIE['user_id']);
    }

    public function getCurrentUser(): User|null
    {
        if ($this->check()) {
            $userId = $_COOKIE['user_id'];

            return $this->userRepository->getUserById($userId);
        }
        return  null;
    }

    public function login(string $email, string $password): bool
    {
        $user = $this->userRepository->getOneByEmail($email);
        if (!$user instanceof User) {
            return false;
        }

        if (!password_verify($password, $user->getPassword())) {
            return false;
        }

        setcookie('user_id', $user->getId(), strtotime("+30 days", '/'));

        return true;
    }

    public function logout(): void
    {
        setcookie('user_id', '', time() -3600, '/');
    }
}