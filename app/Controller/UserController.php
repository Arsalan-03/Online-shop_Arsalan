<?php
namespace Controller;
use Model\User;

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

    public function registrate(array $data): void
    {
        $errors = $this->regValidate($data);

        if (empty($errors)) {

            $name = $data['name'];
            $email = $data['email'];
            $password = $data['psw'];

            $password = password_hash($password, PASSWORD_DEFAULT);

            $this->modelUser->create($name, $email, $password);
            header("Location: /login");
        }

        require_once './../View/registrate.php';
    }

    private function regValidate(array $data): array
    {
        $errors = [];

        if (isset($data['name'])) {
            $name = $data['name'];

            if (strlen($name) < 2) {
                $errors['name'] = 'Имя должен составлять не меньше 2 символов';
            }
        } else {
            $errors['name'] = 'Заполните поле name';
        }

        if (isset($data['email'])) {
            $email = $data['email'];

            if (strlen($email) < 2) {
                $errors['email'] = 'Почта должен составлять не меньше 2 символов';
            } else {
                $str = '@';
                $pos = strpos($email, $str);
                if ($pos === false) {
                    $errors['email'] = 'Почта должен иметь символ @ в строке';
                } elseif (filter_var($email, FILTER_VALIDATE_EMAIL)) {

                    $result = $this->modelUser->getOneByEmail($email);
                    if (!empty($result)) {
                        $errors['email'] = 'Пользователь с таким email уже сущетсвует';
                    }
                }
            }
        } else {
            $errors['email'] = 'Заполните поле email';
        }

        if (isset($data['psw'])) {
            $password = $data['psw'];

            if (strlen($password) < 2) {
                $errors['password'] = 'Паролль должен составлять не меньше 2 символов';
            }
        } else {
            $errors['password'] = 'Заполните поле password';
        }
        if (isset($data['psw-repeat'])) {
            $password_repeat = $data['psw-repeat'];

            if ($password !== $password_repeat) {
                $errors['psw-repeat'] = 'Пароли не совпадают';
            }
        } else {
            $errors['psw-repeat'] = 'Заполните поле password-repeat';
        }
        return $errors;
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
}