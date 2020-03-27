<?php


namespace App\Repository;

require __DIR__."/../../vendor/autoload.php";
use App\Entity\Product;

use App\Utils\DatabaseConnection;

class ProductRepository
{
    private $pdo;

    public function __construct()
    {
        $this->pdo=DatabaseConnection::getConnection();
    }

    public function getProductsByType()
    {
        $productObjects=[];
        $stmt=$this->pdo->query("SELECT * FROM product");
        $products=$stmt->fetchAll();
        foreach ($products as $product){
            $productObjects[]=new Product($product);
        }
        return $productObjects;
    }
    public function getProduct()
    {
        $productObjects=[];
        $stmt=$this->pdo->query("SELECT * FROM product");
        $products=$stmt->fetchAll();
        foreach ($products as $product){
            $productObject=new Product($product);
            $likes=$this->pdo->query(sprintf("SELECT * FROM likes where product_id=%s AND type='like'",$productObject->getId()))->fetchAll(\PDO::FETCH_ASSOC);
            $dislikes=$this->pdo->query(sprintf("SELECT * FROM likes where product_id=%s AND type='unlike'",$productObject->getId()))->fetchAll(\PDO::FETCH_ASSOC);
            if(in_array($_SESSION['user_data']['username']??"",array_column($likes,'username'))){
                $productObject->setUserLikeThisProduct(true);
            }elseif (in_array($_SESSION['user_data']['username']??"", array_column($dislikes, 'username'))){
                $productObject->setUserDislikeThisProduct(true);
            }
            $productObject->setLikes($likes);
            $productObject->setDislikes($dislikes);
            $productObjects[]=$productObject;
            }
        return $productObjects;
        }



    public function getProductsByCategory($categoryId)
    {
        $productObjects=[];
        $stmt=$this->pdo->query(sprintf("SELECT * FROM product WHERE category_id=%s",$categoryId));
        $products=$stmt->fetchAll();
        foreach ($products as $product){
            $productObjects[]=new Product($product);
        }
        return $productObjects;
    }

    public function insertProduct($name,$price,$images,$category_id)
    {
        $query=$this->pdo->query("INSERT INTO product (name,price,images,category_id) VALUE ('$name','$price','$images','$category_id')");

        return $query;
    }
    public function insertCategory($category_name)
    {
        $query=$this->pdo->query("INSERT INTO category (name) VALUE ('$category_name')");

        return $query;
    }
    public function CheckProductById($id)
    {
        $productObjects=[];
        $stmt=$this->pdo->query("SELECT * FROM product where id='$id';");
        $products=$stmt->fetchAll();
        foreach ($products as $product){
            $productObjects[]=new Product($product);
        }
        return $productObjects;

    }
    public function CheckProductById1($id)
    {
        $stmt=$this->pdo->query("SELECT * FROM product where id='$id';");
        $products=$stmt->fetchAll();
        foreach ($products as $product){
            $productObjects=new Product($product);
        }
        return $productObjects;

    }

    public function updateProduct($id,$image,$name,$price,$categoryID)
    {
    $query=$this->pdo->query("UPDATE product SET name='$name', price='$price',images='$image', category_id='$categoryID' WHERE id='$id';");
    return $query;
    }
    public function updateProduct1($id,$name,$price,$categoryID)
    {
        $query=$this->pdo->query("UPDATE product SET name='$name', price='$price', category_id='$categoryID' WHERE id='$id';");
        return $query;
    }
    public function deleteProduct($id){
        $query=$this->pdo->query("DELETE FROM product WHERE id='$id'");
        return $query;
    }

    public function findProductById($id)
    {
        $productObjects=[];
        $stmt=$this->pdo->query("SELECT * FROM product where id='$id';");
        $products=$stmt->fetchAll(\PDO::FETCH_ASSOC);
            foreach ($products as $product){
                $productObject=new Product($product);
                    $likes=$this->pdo->query(sprintf("SELECT * FROM likes where product_id=%s AND type='like'",$productObject->getId()))->fetchAll(\PDO::FETCH_ASSOC);
                    $dislikes=$this->pdo->query(sprintf("SELECT * FROM likes where product_id=%s AND type='unlike'",$productObject->getId()))->fetchAll(\PDO::FETCH_ASSOC);
                        if(in_array($_SESSION['user_data']['username']??"",array_column($likes,'username'))){
                            $productObject->setUserLikeThisProduct(true);
                        }elseif (in_array($_SESSION['user_data']['username']??"", array_column($dislikes, 'username'))){
                            $productObject->setUserDislikeThisProduct(true);
                        }
                        $productObject->setLikes($likes);
                        $productObject->setDislikes($dislikes);
                        $productObjects[]=$productObject;
            }
        return $productObjects;
        }

}