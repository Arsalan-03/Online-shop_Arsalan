<?php

namespace Entity;

class Product
{
    private int $id;
    private string $name;
    private string $image;
    private string $info;
    private int $price;
    private int $quantity;

    public function __construct(int $id, string $name, string $image, string $info, int $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->image = $image;
        $this->info = $info;
        $this->price = $price;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getInfo(): string
    {
        return $this->info;
    }

    public function getPrice(): string
    {
        return $this->price;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }
}

