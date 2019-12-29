<?php


namespace App\Repository;


use App\Entity\ProductCategory;
use App\Utils\DatabaseConnection;

class ProductCategoryRepository
{

    private $pdo;

    public function __construct()
    {
        $this->pdo=DatabaseConnection::getConnection();
    }

    public function getAllCategories()
    {
        $categoriesArray=[];
        $stmt=$this->pdo->query("SELECT * FROM category");
        $products=$stmt->fetchAll();
        foreach ($products as $product)
        {
            $categoriesArray[]=new ProductCategory($product['id'],$product['name']);
        }
        return $categoriesArray;

    }

    public function updateCategory($newName,$CategoryName)
    {
        $query=$this->pdo->query("UPDATE category SET name='$newName' WHERE id='$CategoryName';");
        return $query;
    }


}