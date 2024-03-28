<?php

namespace Controller;

use Service\AuthenticationService\InterfaceAuthenticationService;
use Service\CartService;

class CartController
{
    private InterfaceAuthenticationService $authenticationService;
    private CartService $cartService;

    public function __construct(InterfaceAuthenticationService $authenticationService, CartService $cartService)
    {
        $this->authenticationService = $authenticationService;
        $this->cartService = $cartService;
    }
    public function getCart(): void
    {
       if (!$this->authenticationService->check()) {
            header("Location: /login");
        } else {
           $user = $this->authenticationService->getCurrentUser();
           $userId = $user->getId();

           $userProducts = $this->cartService->getProducts();
           $totalPrice = $this->cartService->getTotalPrice($userId);

            require_once './../View/cart.php';
        }
    }
}