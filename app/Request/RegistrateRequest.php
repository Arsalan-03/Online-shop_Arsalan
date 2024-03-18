<?php

namespace Request;

use Repository\UserRepository;

class RegistrateRequest extends Request
{
    private UserRepository $modelUser;

    public function __construct(array $body)
    {
        parent::__construct($body);
        $this->modelUser = new UserRepository();
    }

    public function getName()
    {
        return $this->body['name'];
    }

    public function getEmail()
    {
        return $this->body['email'];
    }

    public function getPassword()
    {
        return $this->body['psw'];
    }

    public function validate()
    {
        $errors = [];

        if (isset($this->body['name'])) {
            $name = $this->body['name'];

            if (strlen($name) < 2) {
                $errors['name'] = 'Имя должен составлять не меньше 2 символов';
            }
        } else {
            $errors['name'] = 'Заполните поле name';
        }

        if (isset($this->body['email'])) {
            $email = $this->body['email'];

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

        if (isset($this->body['psw'])) {
            $password = $this->body['psw'];

            if (strlen($password) < 2) {
                $errors['password'] = 'Паролль должен составлять не меньше 2 символов';
            }
        } else {
            $errors['password'] = 'Заполните поле password';
        }
        if (isset($this->body['psw-repeat'])) {
            $password_repeat = $this->body['psw-repeat'];

            if ($password !== $password_repeat) {
                $errors['psw-repeat'] = 'Пароли не совпадают';
            }
        } else {
            $errors['psw-repeat'] = 'Заполните поле password-repeat';
        }
        return $errors;
    }
}