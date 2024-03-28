<?php

namespace Core;

use Controller\CartController;
use Controller\MainController;
use Controller\OrderController;
use Controller\ProductController;
use Controller\UserController;
use Repository\UserRepository;
use Service\AuthenticationService\SessionAuthenticationService;
use Service\CartService;
use Service\OrderService;
use Service\ProductService;

class Container
{
    private array $services = [];
    public function set($className, callable $callback): void //СОХРАНЯЕТ ИНФОРМАЦИЮ о том, как создавать объект определённого класса
    {
        $this->services[$className] = $callback;
    }

    public function get($className): object // ВОЗВРАЩАЕТ ОБЪЕКТ указанного класса
    {
        try {
            $callback = $this->services[$className];
        } catch (\Throwable $exception) {
            require_once './../View/505.html';
        }
        return $callback();
    }

    public function save(): void
    {
        $this->set(CartController::class, function () {
            $authService = new SessionAuthenticationService();
            $cartService = new CartService();

            return new CartController($authService, $cartService);
        });

        $this->set(MainController::class, function () {
            $authService = new SessionAuthenticationService();
            $productService = new ProductService();
            $cartService = new CartService();

            return new MainController($authService, $productService, $cartService);
        });

        $this->set(OrderController::class, function () {
            $authService = new SessionAuthenticationService();
            $orderService = new OrderService();

            return new OrderController($authService, $orderService);
        });

        $this->set(ProductController::class, function () {
            $authService = new SessionAuthenticationService();
            $productService = new ProductService();
            $cartService = new CartService();

            return new ProductController($authService, $productService, $cartService);
        });

        $this->set(UserController::class, function () {
            $authService = new SessionAuthenticationService();
            $userRepository = new UserRepository();

            return new UserController($authService, $userRepository);
        });
    }
}