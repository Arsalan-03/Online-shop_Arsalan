<?php

namespace Request;

use Model\User;

class LoginRequest extends Request
{
    private User $modelUser;

    public function __construct(array $body)
    {
        parent::__construct($body);
        $this->modelUser = new User();
    }

    public function getEmail()
    {
        return $this->body['email'];
    }

    public function getPassword()
    {
        return $this->body['password'];
    }
    public function validate()
    {
        $errors = [];

        $email = $this->body['email'];
        $password = $this->body['password'];

        $user = $this->modelUser->getOneByEmail($email);
        if (empty($user)) {
            $errors['email'] = 'Пользователя не существует';
        } elseif (!password_verify($password, $user->getPassword())) {
            $errors['password'] = 'Неправильный логин или пароль';
        }
        return $errors;
    }
}