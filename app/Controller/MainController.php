<?php
namespace Controller;
use Model\Product;

require_once './../Model/Product.php';
class MainController
{
    private Product $modelProduct;

    public function __construct()
    {
        $this->modelProduct = new Product();
    }
    public function getProducts()
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login.php");
        } else {

           $products = $this->modelProduct->getAll();

            if (empty($products)) {
                echo 'Продуктов в таблице нет';
                die;
            }
            require_once './../View/main.php';
        }
    }
}