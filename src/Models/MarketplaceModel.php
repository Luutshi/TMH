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

    public function insertProduct($name, $category, $description, $price)
    {
        $statement = $this->pdo->prepare('INSERT INTO `product` (`name`, `category`, `description`, `price`) VALUES (:name, :category, :description, :price)');
        $statement->execute([
            'name' => $name,
            'category' => $category,
            'description' => $description,
            'price' => $price,
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
}