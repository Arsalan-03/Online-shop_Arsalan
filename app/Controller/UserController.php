<?php
namespace Controller;

use Repository\UserRepository;
use Request\LoginRequest;
use Request\RegistrateRequest;
use Service\AuthenticationService\InterfaceAuthenticationService;

class UserController
{
    private UserRepository $userRepository;
    private InterfaceAuthenticationService $authenticationService;

    public function __construct(InterfaceAuthenticationService $authenticationService, UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->authenticationService = $authenticationService;
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

            $this->userRepository->create($name, $email, $password);
            header("Location: /login");
        }

        require_once './../View/registrate.php';
    }

    public function getLogin(): void
    {
        require_once './../View/login.php';
    }

    public function login(LoginRequest $request): void
    {
        $errors = $request->validate();

        if (empty($errors)) {
            $email = $request->getEmail();
            $password = $request->getPassword();

            if ($this->authenticationService->login($email, $password)) {
                header("Location: /main");

            } else {
                $errors['email'] = 'Неправильный логин или пароль';
            }
        }
        require_once './../View/login.php';
    }

    public function logout(RegistrateRequest $request): void
    {
        $this->authenticationService->logout();
        header("Location: /login");
    }
}