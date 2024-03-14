<?php

namespace Model;

class Order extends Model
{
    public function addOrder(string $email, string $phone, string $name, string $address, string $city, string $country, string $postal): void
    {
       $statement = $this->pdo->prepare("INSERT INTO orders(email, phone, name, address, city, country, postal) VALUES(:email, :phone, :name, :address, :city, :country, :postal)");
       $statement->execute(['email' => $email, 'phone' => $phone, 'name' => $name, 'address' => $address, 'city' => $city, 'country' => $country, 'postal' => $postal]);
    }

    public function getUserOrder(string $email):void
    {
        $statement = $this->pdo->prepare("SELECT id FROM orders WHERE email=:email");
        $statement->execute(['email' => $email]);
    }
}