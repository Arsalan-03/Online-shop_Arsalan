<?php

namespace Repository;

class OrderRepository extends Repository
{
    public function addOrder(string $email, string $phone, string $name, string $address, string $city, string $country, string $postal): void
    {
       $statement = self::getPdo()->prepare("INSERT INTO orders(email, phone, name, address, city, country, postal) VALUES(:email, :phone, :name, :address, :city, :country, :postal)");
       $statement->execute(['email' => $email, 'phone' => $phone, 'name' => $name, 'address' => $address, 'city' => $city, 'country' => $country, 'postal' => $postal]);
    }

    public function getOrderId(): int
    {
        return self::getPdo()->lastInsertId();
    }
}