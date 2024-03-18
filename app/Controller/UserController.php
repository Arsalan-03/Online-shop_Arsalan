<?php
namespace Controller;
use Model\User;
use Request\LoginRequest;
use Request\RegistrateRequest;

class UserController
{
    private User $modelUser;

    public function __construct()
    {
        $this->modelUser = new User();
    }
    public function getRegistrate()
    {
        require_once './../View/registrate.php';
    }

    public function registrate(RegistrateRequest $request): void
    {
        $errors = $request->validate();

        if (empty($errors)) {

            $name = $request->getName();
            $email = $request->getEmail();
            $password = $request->getPassword();

            $password = password_hash($password, PASSWORD_DEFAULT);

            $this->modelUser->create($name, $email, $password);
            header("Location: /login");
        }

        require_once './../View/registrate.php';
    }

    public function getLogin()
    {
        require_once './../View/login.php';
    }

    public function login(LoginRequest $request): void
    {
        $errors = $request->validate();

        if (empty($errors)) {
            $user = $this->modelUser->getOneByEmail($request->getEmail());

            session_start();
            $_SESSION['user_id'] = $user->getId();
            header("Location: /main");
        }
        require_once './../View/login.php';
    }

    public function logout(RegistrateRequest $request): void
    {
        session_start();

        if (session_status() === PHP_SESSION_ACTIVE) {
            session_destroy();

            header("Location: /login");
        }
    }
}