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

       $errors = $this->validateOrders($data);

        if (empty($errors)) {
            $userId = $_SESSION['user_id'];

            $email = $data['email'];
            $phone = $data['phone'];
            $name = $data['name'];
            $address = $data['address'];
            $city = $data['city'];
            $country = $data['country'];
            $postal = $data['postal'];

           $productId['product_id'] = $this->order->addOrder($email, $phone, $name, $address, $city, $country, $postal);
           $this->userProduct->getOneByUserIdProductId($userId, $productId);
           $this->userProduct->deleteProduct($userId, $productId);
        }

        require_once './../View/order.php';
    }

    private function validateOrders(array $data): array
    {
        $errors = [];

        if (isset($data['email'])) {
            $email = $data['email'];

            $str = '@';
            $pos = strpos($email, $str);

            if ($pos === false) {
                $errors['email'] = 'Неккоректно введен поле email';
            } elseif (strlen($email) < 2) {
                $errors['email'] = 'Недостаточно символов в строке';
            }
        } else {
            $errors['email'] = 'Заполните поле email';
        }

        if (isset($data['phone'])) {
            $phone = $data['phone'];

            if (!preg_match('/^\d+$/', $phone)) {
                $errors['phone'] = 'Недопустимый номер телефона';
            } elseif(strlen($phone) != 11) {
                $errors['phone'] = 'Доступна только для Российских номеров';
            } elseif (!in_array($phone[0], ['7', '8'])) {
                $errors['phone'] = 'Номер телефона может начинаться только с 7 или 8';
            }
        } else {
            $errors['phone'] = 'Заполните поле phone';
        }

        if (isset($data['name'])) {
            $name = $data['name'];

            if (!preg_match('/^[a-zA-Zа-яА-Я\s]+$/', $name)) {
               $errors['name'] = 'Неккоректно введён поле name';
            } elseif (strlen($name) < 8) {
                $errors['name'] = 'Недостаточно символов в строке';
            }
        } else {
            $errors['name'] = 'Заполните поле name';
        }
        if (isset($data['address'])) {
            $address = $data['address'];

            if (strlen($address) < 3) {
                $errors['address'] = 'Недостаточно символов в строке';
            }
        } else {
            $errors['address'] = 'Заполните поле address';
        }

        if (isset($data['city'])) {
            $city = $data['city'];

            if (strlen($city) < 2) {
                $errors['city'] = 'Недостаточно символов в строке';
            }
        } else {
            $errors['city'] = 'Заполните поле city';
        }

        if (isset($data['country'])) {
            $country = $data['country'];
        } else {
            $errors['country'] = 'Заполните поле country';
        }

        if (isset($data['postal'])) {
            $postal = $data['postal'];

            if (!preg_match('/^\d+$/', $postal)) {
                $errors['postal'] = 'Неккоректно ведён поле postal';
            }
        } else {
            $errors['postal'] = 'Заполните поле postal';
        }
        return  $errors;
    }
}