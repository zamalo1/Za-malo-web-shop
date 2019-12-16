<?php


namespace App\Repository;


use App\Entity\Product;
use App\Entity\ProductCategory;
use App\Utils\DatabaseConnection;

class ProductRepository
{
    public $mesage=[];
    public $nameMessage=[];
    public $PriceMessage=[];
    public $ImageMessage=[];
    public $CategoryMessage=[];
    public $fileMessage=[];

    private $pdo;
    private $_suporttedFormats = ['image/png', 'image/jpg', 'image/jpeg', 'image/gif'];

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
    public function addProduct($file)
    {
        if (!is_array($file)){
            return $this->fileMessage;
        }elseif(!in_array($file['type'], $this->_suporttedFormats)) {
            $this->fileMessage[]='(You must add a file!!!)';
            return $this->fileMessage;
            }elseif(!$file['error']===0) {
            $this->fileMessage[] = '(There is a error!!!)';
            return $this->fileMessage;
        }elseif($file['size']>=1000000){
            $this->fileMessage[] = '(This file is too large!!!)';
            return $this->fileMessage;
        }elseif (!empty($_POST)) {
        if(empty($_POST['product_name'])) {
            $this->nameMessage[] = '(What`s name of your product!!!)';
            return $this->nameMessage;
        } elseif (empty($_POST['product_price'])) {
            $this->PriceMessage[] = '(What`s price of your product!!!)';
            return $this->PriceMessage;
        } elseif (empty($_POST['category_id'])) {
            $this->CategoryMessage[] = '(What`s category id of your product!!!)';
            return $this->CategoryMessage;
        }else{
            move_uploaded_file($file['tmp_name'], 'C:/wamp64/www/HtmlCSS/webstore/assets/images/'. $file['name']);
            $this->insertProduct($_POST['product_name'], $_POST['product_price'], $_FILES['image']['name'], $_POST['category_id']);
            $this->mesage[]='(Successfully added product!!!)';
            return $this->mesage;
            }
        }
    }

    public function addCategory()
    {
        if (!empty($_POST) ) {
            if (empty($_POST['category_name'])) {
                $this->CategoryMessage[] = '(What`s name of your category!!!)';
                return $this->CategoryMessage;
            } else {
                $insertCategory = new ProductRepository();
                $insertCategory->insertCategory($_POST['category_name']);
                $this->nameMessage[] = '(successfully added category!!!)';
                return $this->nameMessage;
            }
        }
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

    public function AdminUpdateProduct($id)
    {
        if(isset($_POST['upload'])) {

            if (empty($_POST['product_name'])) {
                $this->nameMessage[] = 'What`s name of your product';
                return $this->nameMessage;
            } elseif (empty($_POST['product_price'])) {
                $this->PriceMessage[] = 'What`s price of your product';
                return $this->PriceMessage;
            } elseif (isset($_FILES['image']['name']) && $_FILES['image']['name']!=="") {
                $sql = $this->pdo->query("select images from product where id='$id'");
                $products = $sql->fetchAll();
                foreach ($products as $product) {
                    unlink("C:/wamp64/www/HtmlCSS/webstore/assets/images/$product[0]");
                    move_uploaded_file($_FILES['image']['tmp_name'], 'C:/wamp64/www/HtmlCSS/webstore/assets/images/' . $_FILES['image']['name']);
                    $this->updateProduct($id, $_FILES['image']['name'], $_POST['product_name'], $_POST['product_price'], $_POST['category_id']);
                    $this->mesage[] = 'Successful update';
                    return $this->mesage;
                }
            }else{
                $this->updateProduct1($id,$_POST['product_name'], $_POST['product_price'], $_POST['category_id']);
                $this->mesage[] = 'Successful update';
                return $this->mesage;
            }
        }
    }

    public function AdminDeleteProduct($id)
    {
        if(isset($_POST['delete'])) {
            $sql = $this->pdo->query("select images from product where id='$id'");
            $products = $sql->fetchAll();
            foreach ($products as $product) {
                unlink("C:/wamp64/www/HtmlCSS/webstore/assets/images/$product[0]");
                $this->deleteProduct($id);
                header(sprintf("Location:%s?page=product_list", $_SERVER['SCRIPT_NAME']));
            }
        }
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

}