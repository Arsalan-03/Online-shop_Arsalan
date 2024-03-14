<?php

namespace Request;

class OrderRequest extends Request
{

    public function getEmail()
    {
        return $this->body['email'];
    }

    public function getPhone()
    {
        return $this->body['phone'];
    }

    public function getName()
    {
        return $this->body['name'];
    }

    public function getAddress()
    {
        return $this->body['address'];
    }

    public function getCity()
    {
        return $this->body['city'];
    }

    public function getCountry()
    {
        return $this->body['country'];
    }

    public function getPostal()
    {
        return $this->body['postal'];
    }

    public function validate()
    {
        $errors = [];

        if (isset($this->body['email'])) {
            $email = $this->body['email'];

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

        if (isset($this->body['phone'])) {
            $phone = $this->body['phone'];

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

        if (isset($this->body['name'])) {
            $name = $this->body['name'];

            if (!preg_match('/^[a-zA-Zа-яА-Я\s]+$/', $name)) {
                $errors['name'] = 'Неккоректно введён поле name';
            } elseif (strlen($name) < 8) {
                $errors['name'] = 'Недостаточно символов в строке';
            }
        } else {
            $errors['name'] = 'Заполните поле name';
        }
        if (isset($this->body['address'])) {
            $address = $this->body['address'];

            if (strlen($address) < 3) {
                $errors['address'] = 'Недостаточно символов в строке';
            }
        } else {
            $errors['address'] = 'Заполните поле address';
        }

        if (isset($this->body['city'])) {
            $city = $this->body['city'];

            if (strlen($city) < 2) {
                $errors['city'] = 'Недостаточно символов в строке';
            }
        } else {
            $errors['city'] = 'Заполните поле city';
        }

        if (isset($this->body['country'])) {
            $country = $this->body['country'];
        } else {
            $errors['country'] = 'Заполните поле country';
        }

        if (isset($this->body['postal'])) {
            $postal = $this->body['postal'];

            if (!preg_match('/^\d+$/', $postal)) {
                $errors['postal'] = 'Неккоректно ведён поле postal';
            }
        } else {
            $errors['postal'] = 'Заполните поле postal';
        }
        return  $errors;
    }
}