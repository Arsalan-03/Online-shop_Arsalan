<?php

namespace Service;

use Repository\OrderProductRepository;
use Repository\OrderRepository;
use Repository\UserProductRepository;
class OrderService
{
    private OrderRepository $orderRepository;
    private OrderProductRepository $orderProductRepository;
   private UserProductRepository $userProductRepository;

    public function __construct()
    {
        $this->orderRepository = new OrderRepository();
        $this->orderProductRepository = new OrderProductRepository();
        $this->userProductRepository = new UserProductRepository();
    }
    public function create(int $userId, string $email, string $phone, string $name, string $address, string $city, string $country, string $postal): void
    {
        $this->orderRepository->addOrder($email, $phone, $name, $address, $city, $country, $postal);
        $orderId = $this->orderRepository->getOrderId();

        $this->orderProductRepository->addOrderProduct($userId, $orderId);
        $this->userProductRepository->deleteProducts($userId);
    }
}