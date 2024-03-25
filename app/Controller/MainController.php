<?php
namespace Controller;

use Repository\ProductRepository;
use Repository\UserProductRepository;
use Service\AuthenticationService;
use Service\CartService;
use Service\ProductService;

class MainController
{
    private ProductRepository $productModel;
    private AuthenticationService $authenticationService;
    private CartService $cartService;

    public function __construct()
    {
        $this->productModel = new ProductRepository();
        $this->authenticationService = new AuthenticationService();
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