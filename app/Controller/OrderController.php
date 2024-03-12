<?php

namespace Controller;

use Model\Order;
use Model\UserProduct;

class OrderController
{
    private Order $order;
    private UserProduct $userProduct;

    public function __construct()
    {
        $this->order = new Order();
        $this->userProduct = new UserProduct();
    }

    public function getOrders()
    {
        session_start();

        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
        }


        require_once './../View/order.php';
    }

    public function orders(array $data): void
    {
        session_start();

        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
        }
        $userId = $_SESSION['user_id'];
        $productId =  //докончить

        $email = $data['email'];
        $phone = $data['phone'];
        $name = $data['name'];
        $address = $data['address'];
        $city = $data['city'];
        $country = $data['country'];
        $postal = $data['postal'];

        $this->order->addOrder($email, $phone, $name, $address, $city, $country, $postal);
        $this->userProduct->getOneByUserIdProductId($userId, $productId);
        $this->userProduct->deleteProduct($userId, $productId);
    }

    private function validateOrders(array $data): array
    {

    }
}