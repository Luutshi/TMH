<?php

namespace Mvc\Models;

use Config\Model;
use PDO;

class MarketplaceModel extends Model
{
    public function eachProducts()
    {
        $statement = $this->pdo->prepare('SELECT * FROM `product`');
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductByID($id) {
        $statement = $this->pdo->prepare('SELECT * FROM `product` WHERE `id` = :id');
        $statement->execute([
            'id' => $id
        ]);

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function insertProduct($name, $category, $description, $price, $image1, $image2, $image3)
    {
        $statement = $this->pdo->prepare('INSERT INTO `product` (`name`, `category`, `description`, `price`,  `image1`, `image2`, `image3`) VALUES (:name, :category, :description, :price, :image1, :image2, :image3)');
        $statement->execute([
            'name' => $name,
            'category' => $category,
            'description' => $description,
            'price' => $price,
            'image1' => $image1,
            'image2' => $image2,
            'image3' => $image3,
        ]);
    }

    public function deleteProduct($productID)
    {
        $statement = $this->pdo->prepare('DELETE FROM `product` WHERE id = :id');
        $statement->execute([
            'id' => $productID
        ]);
    }

    public function eachCategories()
    {
        $statement = $this->pdo->prepare('SELECT * FROM `category`');
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertCategory($name)
    {
        $statement = $this->pdo->prepare('INSERT INTO `category` (`name`) VALUES (:name)');
        $statement->execute([
            'name' => $name,
        ]);
    }

    public function deleteCategory($categoryID)
    {
        $statement = $this->pdo->prepare('DELETE FROM `category` WHERE id = :id');
        $statement->execute([
            'id' => $categoryID
        ]);
    }

    public function addToCart($userID, $productID)
    {
        $statement = $this->pdo->prepare('INSERT INTO `user_cart` (`user_id`, `product_id`) VALUES (:user_id, :product_id)');
        $statement->execute([
            'user_id' => $userID,
            'product_id' => $productID
        ]);
    }

    public function deleteFromCart($userID, $productID)
    {
        $statement = $this->pdo->prepare('DELETE FROM `user_cart` WHERE product_id = :product_id AND user_id = :user_id LIMIT 1');
        $statement->execute([
            'user_id' => $userID,
            'product_id' => $productID
        ]);
    }

    public function deleteCart($userID)
    {
        $statement = $this->pdo->prepare('DELETE FROM `user_cart` WHERE user_id = :user_id');
        $statement->execute([
            'user_id' => $userID,
        ]);
    }

    public function eachProductFromCart($userID)
    {
        $statement = $this->pdo->prepare('SELECT product.id, name, category, description, price, image1 FROM `user_cart` LEFT JOIN product ON user_cart.product_id = product.id WHERE user_id = :user_id');
        $statement->execute([
            'user_id' => $userID,
        ]);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertProductCommand($userID, $productID, $date)
    {
        $statement = $this->pdo->prepare('INSERT INTO `command` (`user_id`, `product_id`, `commandDate`) VALUES (:user_id, :product_id, :date)');
        $statement->execute([
            'user_id' => $userID,
            'product_id' => $productID,
            'date' => $date
        ]);
    }

    public function eachCommands($userID)
    {
        $statement = $this->pdo->prepare('SELECT * FROM `command` LEFT JOIN product ON product.id = command.product_id WHERE user_id = :user_id');
        $statement->execute([
            'user_id' => $userID,
        ]);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}