<?php
namespace Repository;

use Entity\UserProduct;
use Repository\Repository;

class UserProductRepository extends Repository
{
    public function addProduct(int $userId, int $productId, int $quantity): void
    {
        $stmt = $this->pdo->prepare("INSERT INTO user_products(user_id, product_id, quantity) VALUES(:user_id, :product_id, :quantity)");
        $stmt->execute(['user_id' => $userId, 'product_id' => $productId, 'quantity' => $quantity]);
    }

    public function getOneByUserIdProductId(int $userId, int $productId): UserProduct|null
    {
        $stmt = $this->pdo->prepare("SELECT * FROM user_products WHERE user_id=:user_id and product_id=:product_id");
        $stmt->execute(['user_id' => $userId, 'product_id' => $productId]);

        $product = $stmt->fetch();

        if (empty($product)) {
            return null;
        }

        return $this->hydrate($product);
    }

    public function updateQuantityPlus(int $quantity, int $userId, int $productId): void
    {
        $stmt = $this->pdo->prepare("UPDATE user_products SET quantity = (quantity + :quantity) WHERE user_id=:user_id and product_id=:product_id");
        $stmt->execute(['quantity' => $quantity, 'user_id' => $userId, 'product_id' => $productId]);
    }

    public function updateQuantityMinus(int $userId, int $productId): void
    {
        $stmt = $this->pdo->prepare("UPDATE user_products SET quantity = (quantity - 1) WHERE user_id=:user_id and product_id=:product_id");
        $stmt->execute(['user_id' => $userId, 'product_id' => $productId]);
    }

    public function getCartProduct(int $userId): UserProduct|null
    {
        $stmt = $this->pdo->prepare("SELECT user_products.user_id, user_products.quantity, user_products.product_id FROM products JOIN user_products ON products.id = user_products.product_id WHERE user_id=:user_id");
        $stmt->execute(['user_id' => $userId]);
        $cart = $stmt->fetchAll();

        if (empty($cart)) {
            return null;
        }

        return $this->hydrate($cart);
    }

    public function getAllUserProducts(int $userId): array
    {
       $stmt = $this->pdo->prepare("SELECT * FROM user_products 
         JOIN products ON products.id = user_products.product_id 
         JOIN users ON users.id = user_products.user_id
         WHERE user_id=:user_id
         ");
       $stmt->execute(['user_id' => $userId]);

       $userProducts = $stmt->fetchAll();
       $result = [];
       foreach ($userProducts as $userProduct) {
           $userProductModel = new UserProductRepository($userProduct['user_products.id'], $userProduct['user_id'], $userProduct['user_products.product_id'], $userProduct['quantity']);
           $product = new ProductRepository($userProduct['product.id'], $userProduct['product.name'], $userProduct['image'], $userProduct['price']);
           $user = new UserRepository($userProduct['user.id'], $userProduct['user.name'], $userProduct['email'], $userProduct['password']);
           $result[] = new UserProduct($userProductModel['id'], $userProductModel['user_id'], $userProductModel['product_id'], $userProductModel['quantity']);
       }
       return $result;
    }

    public function deleteProducts(int $userId): array|false
    {
        $stmt = $this->pdo->prepare("DELETE FROM user_products WHERE user_id=:user_id");
        $stmt->execute(['user_id' => $userId]);

        return $stmt->fetch();
    }

    public function hydrate(array $data): UserProduct
    {
        return new UserProduct($data['id'], $data['user_id'], $data['product_id'], $data['quantity']);
    }
}