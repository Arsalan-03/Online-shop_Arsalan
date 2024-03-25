<?php

namespace Controller;

use Repository\OrderRepository;
use Repository\OrderProductRepository;
use Repository\UserProductRepository;
use Request\OrderRequest;
use Service\AuthenticationService;
use Service\OrderService;

class OrderController
{
    private AuthenticationService $authenticationService;
    private OrderService $orderService;

    public function __construct()
    {
        $this->authenticationService = new AuthenticationService();
        $this->orderService = new OrderService();
    }

    public function getOrders(): void
    {
        if (!$this->authenticationService->check()) {
            header("Location: /login");
        }

        require_once './../View/order.php';
    }

    public function order(OrderRequest $request): void
    {
        if (!$this->authenticationService->check()) {
            header("Location: /login");
        }

        $user = $this->authenticationService->getCurrentUser();
        $userId = $user->getId();

        $errors = $request->validate();
        if (empty($errors)) {
            $email = $request->getEmail();
            $phone = $request->getPhone();
            $name = $request->getName();
            $address = $request->getAddress();
            $city = $request->getCity();
            $country = $request->getCountry();
            $postal = $request->getPostal();

            $this->orderService->create($userId, $email, $phone, $name, $address, $city, $country, $postal);

            header("Location: /main");
        }
        require_once './../View/order.php';
    }
}