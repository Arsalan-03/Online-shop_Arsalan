<?php
namespace Controller;
use Model\User;
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

    public function login(array $data): void
    {
        $errors = $this->logValidate($data);

        if (empty($errors)) {
            $user = $this->modelUser->getOneByEmail($data['email']);

            session_start();
            $_SESSION['user_id'] = $user['id'];
            header("Location: /main");
        }
        require_once './../View/login.php';
    }

    private function logValidate(array $data): array
    {
        $errors = [];

        $email = $data['email'];
        $password = $data['password'];

        $user = $this->modelUser->getOneByEmail($email);
        if (empty($user)) {
            $errors['email'] = 'Пользователя не существует';
        } elseif (!password_verify($password, $user['password'])) {
            $errors['password'] = 'Неправильный логин или пароль';
        }
        return $errors;
    }
    public function logout(): void
    {
        session_start();

        if (session_status() === PHP_SESSION_ACTIVE) {
            session_destroy();

            header("Location: /login");
        }
    }
}