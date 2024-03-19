<?php

namespace Controller;

use Repository\OrderRepository;
use Repository\OrderProductRepository;
use Repository\UserProductRepository;
use Request\OrderRequest;

class OrderController
{
    private OrderRepository $order;
    private UserProductRepository $userProduct;
    private OrderProductRepository $orderProduct;

    public function __construct()
    {
        $this->order = new OrderRepository();
        $this->userProduct = new UserProductRepository();
        $this->orderProduct = new OrderProductRepository();
    }

    public function getOrders()
    {
        session_start();

        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
        }


        require_once './../View/order.php';
    }

    public function order(OrderRequest $request): void
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            
        }

        $userId = $_SESSION['user_id'];

        $this->createOrder($request);
        $orderId = $this->order->getOrderId();

        $this->orderProduct->addOrderProduct($userId, $orderId);
        $this->userProduct->deleteProducts($userId);
        header("Location: /main");

        require_once './../View/order.php';
    }

    private function createOrder(OrderRequest $request): void
    {
        $errors = $request->validate();

        if (empty($errors)) {
            $email = $request->getEmail();
            $phone = $request->getPhone();
            $name = $request->getName();
            $address = $request->getAddress();
            $city = $request->getCity();
            $country = $request->getCountry();
            $postal = $request->getPostal();

            $this->order->addOrder($email, $phone, $name, $address, $city, $country, $postal);
        }
    }
}