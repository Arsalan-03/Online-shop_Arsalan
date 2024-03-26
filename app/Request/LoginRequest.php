<?php

namespace Request;

use Repository\UserRepository;

class LoginRequest extends Request
{
    private UserRepository $modelUser;

    public function __construct(array $body)
    {
        parent::__construct($body);
        $this->modelUser = new UserRepository();
    }

    public function getEmail()
    {
        return $this->body['email'];
    }

    public function getPassword()
    {
        return $this->body['password'];
    }
    public function validate(): array
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