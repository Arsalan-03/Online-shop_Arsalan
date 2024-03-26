<?php

namespace Controller;

use Service\AuthenticationService\InterfaceAuthenticationService;
use Service\AuthenticationService\SessionAuthenticationService;
use Service\CartService;

class CartController
{
    private InterfaceAuthenticationService $authenticationService;
    private CartService $cartService;

    public function __construct(InterfaceAuthenticationService $authenticationService)
    {
        $this->authenticationService = $authenticationService;
        $this->cartService = new CartService();
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