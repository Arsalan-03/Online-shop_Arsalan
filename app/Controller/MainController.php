<?php
namespace Controller;

use Repository\ProductRepository;
use Service\AuthenticationService\SessionAuthenticationService;
use Service\CartService;
use Service\ProductService;

class MainController
{
    private ProductRepository $productModel;
    private SessionAuthenticationService $authenticationService;
    private CartService $cartService;

    public function __construct()
    {
        $this->productModel = new ProductRepository();
        $this->authenticationService = new SessionAuthenticationService();
        $this->cartService = new CartService();}
    public function getProducts(): void
    {
       if (!$this->authenticationService->check()) {
            header("Location: /login");
        } else {
           $user = $this->authenticationService->getCurrentUser();
           $userId = $user->getId();

           $products = $this->productModel->getAll();
           $userProducts = $this->cartService->getProducts();
           $totalQuantity = $this->cartService->getCountQuantity();

            require_once './../View/main.php';
        }
    }
}