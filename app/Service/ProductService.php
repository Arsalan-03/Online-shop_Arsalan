<?php

namespace Service;

use Entity\User;
use Repository\ProductRepository;
use Service\AuthenticationService\SessionAuthenticationService;

class ProductService
{
    private SessionAuthenticationService $authenticationService;
    private ProductRepository $productRepository;

    public function __construct()
    {
        $this->authenticationService = new SessionAuthenticationService();
        $this->productRepository = new ProductRepository();
    }

    public function getAll(): array
    {
        $user = $this->authenticationService->getCurrentUser();
        if (!$user instanceof User) {
        return [];
        }

        return $this->productRepository->getAll();
    }
}