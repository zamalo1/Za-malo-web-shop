<?php


namespace App\Repository;


use App\Entity\ProductCategory;
use App\Utils\DatabaseConnection;

class ProductCategoryRepository
{
    public $oldMessage=[];
    public $newMessage=[];
    public $mesage=[];
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
    public function AdminUpdateCategory()
    {
        if(!isset($_POST)) {
            $this->mesage;
            return $this->mesage;
        }elseif (empty($_POST['new_name'])){
                $this->newMessage[]='What`s name of your category!!!';
        }else{
            $this->updateCategory($_POST['new_name'],$_POST['category_name']);
            $this->mesage[]='Successful update!!!';
            return $this->mesage;
        }
    }
    public function updateCategory($newName,$CategoryName)
    {
        $query=$this->pdo->query("UPDATE category SET name='$newName' WHERE id='$CategoryName';");
        return $query;
    }


}