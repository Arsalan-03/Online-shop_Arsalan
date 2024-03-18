<?php

namespace Request;

class ProductRequest extends Request
{
    public function getName()
    {
        return $this->body['name'];
    }

    public function getImage()
    {
        return $this->body['image'];
    }

    public function getInfo()
    {
        return $this->body['info'];
    }

    public function getPrice()
    {
        return $this->body['price'];
    }

    public function getProduct()
    {
        return $this->body['product_id'];
    }

    public function getQuantity()
    {
        return $this->body['quantity'];
    }

    public function validate($quantity)
    {
        $errors = [];

        if ($quantity <= 0) {

            $errors['quantity'] = "Вы ввели неккоректное значение, попробуйте снова";
        }
        return $errors;
    }
}