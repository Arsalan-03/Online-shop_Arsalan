<?php

namespace Request;

use Repository\UserProductRepository;

class ProductRequest extends Request
{

    private UserProductRepository $userProductRepository;

    public function __construct(array $body)
    {
        parent::__construct($body);
        $this->userProductRepository = new UserProductRepository();
    }
    public function getProductId()
    {
        return $this->body['product_id'];
    }

    public function getQuantity()
    {
        return $this->body['quantity'];
    }

    public function addValidate(int $userId): array
    {
        $errors = [];

        $product = $this->userProductRepository->getOneByUserIdProductId($userId, $this->getProductId());
        if ($product === null || $product->getQuantity() <= '0') {
            $errors['product_id'] = "Товара в корзине не найдено";
        }

        return $errors;
    }

    public function deleteValidate(int $userId): array
    {
        $errors = [];

        if ($this->getQuantity() <= '0') {
            $errors['quantity'] = "Неккоректно ведён quantity";
        }
        return $errors;
    }
}