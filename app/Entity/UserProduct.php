<?php

namespace Entity;

class UserProduct
{
    private int $id;
    private User $user;
    private Product $product;
    private int $quantity;

    public function __construct(int $id, User $user, Product $product, int $quantity)
    {
        $this->id = $id;
        $this->user = $user;
        $this->product = $product;
        $this->quantity = $quantity;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }
}