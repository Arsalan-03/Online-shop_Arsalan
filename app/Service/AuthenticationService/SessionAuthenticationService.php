<?php

namespace Service\AuthenticationService;

use Entity\User;
use Repository\UserRepository;

class SessionAuthenticationService implements InterfaceAuthenticationService
{

    private UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }
    public function check(): bool
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        return isset($_SESSION['user_id']);
    }

    public function getCurrentUser(): User|null
    {
        if ($this->check()) {
            $userId = $_SESSION['user_id'];

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
        session_start();
        $_SESSION['user_id'] = $user->getId();

        return true;
    }

    public function logout(): void
    {
        session_start();

        if (session_status() === PHP_SESSION_ACTIVE) {
            session_destroy();
        }
    }
}