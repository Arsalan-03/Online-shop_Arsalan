<?php

namespace Service;

use Entity\User;
use Repository\UserProductRepository;
use Service\AuthenticationService\SessionAuthenticationService;

class CartService
{
    private UserProductRepository $userProductRepository;
    private SessionAuthenticationService $authenticationService;

    public function __construct()
    {
        $this->userProductRepository = new UserProductRepository();
        $this->authenticationService = new SessionAuthenticationService();
    }

    public function getTotalPrice(): int
    {
        $user = $this->authenticationService->getCurrentUser();
        if (!$user instanceof User) { //принадлежит ли $user классу USER?
            return 0;
        }
        $userId = $user->getId();

        $userProducts = $this->userProductRepository->getAllUserProducts($userId);

        $totalPrice = 0;

        if (!empty($userProducts)) {
            foreach ($userProducts as $userProduct) {
                $totalPrice += $userProduct->getProduct()->getPrice() * $userProduct->getQuantity();
            }
        }

        return $totalPrice;
    }

    public function addProduct(int $quantity, int $productId): void
    {
        $user = $this->authenticationService->getCurrentUser();
        if (!$user instanceof User) {
            return;
        }
        $userId = $user->getId();

        $userProduct = $this->userProductRepository->getOneByUserIdProductId($userId, $productId);

        if (empty($userProduct)) {
            $this->userProductRepository->addProduct($userId, $productId, $quantity);
        } else {
            $this->userProductRepository->updateQuantityPlus($quantity, $userId, $productId);
        }
    }

    public function getCountQuantity(): int
    {
        $user = $this->authenticationService->getCurrentUser();
        if (!$user instanceof User) {
            return 0;
        }
        $totalQuantity = 0;
        $cartProducts = $this->getProducts();
        if (!empty($cartProducts)) {
            foreach ($cartProducts as $cartProduct) {
                $totalQuantity += $cartProduct->getQuantity();
            }
        }

        return $totalQuantity;
    }

    public function getProducts(): array
    {
        $user = $this->authenticationService->getCurrentUser();
        if (!$user instanceof User) {
            return [];
        }

        $userId = $user->getId();
        return $this->userProductRepository->getAllUserProducts($userId);
    }

    public function clearCartByUserIdProductId($productId): void
    {
        $user = $this->authenticationService->getCurrentUser();
        if (!$user instanceof User) {
            return;
        }
        $this->userProductRepository->updateQuantityMinus($user->getId(), $productId);
    }
}