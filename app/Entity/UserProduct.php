<?php

namespace Entity;

class UserProduct
{
    private int $id;
    private int $user_id;
    private int $product_id;
    private int $quantity;

    public function __construct(int $id, int $user_id, int $product_id, int $quantity)
    {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->product_id = $product_id;
        $this->quantity = $quantity;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getProductId(): int
    {
        return $this->product_id;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }
}