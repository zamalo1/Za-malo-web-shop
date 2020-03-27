<?php


namespace App\Services;
use App\Repository\CommentRepository;
use App\Repository\ProductRepository;
use App\Repository\ProductCategoryRepository;
use App\Repository\UserRepository;
use App\Utils\DatabaseConnection;
use App\Repository\LikesRepository;

class Engine
{
    public $mesage=[];
    public $messages=[];
    public $message1=[];
    public $message2=[];
    public $message3=[];
    public $message4=[];
    public $message5=[];

    private $pdo;
    private $_suporttedFormats = ['image/png', 'image/jpg', 'image/jpeg', 'image/gif'];
    private $parameters;
    private $CommentRepository;
    private $LikeRepository;
    public function __construct($parameters)
    {
        $this->pdo=DatabaseConnection::getConnection();
        $this->parameters=$parameters;
        $this->CommentRepository=new CommentRepository();
        $this->LikeRepository=new LikesRepository();
    }

    public function addProduct($file)
    {
        if (!is_array($file)){
            return $this->message1;
        }elseif(!in_array($file['type'], $this->_suporttedFormats)) {
            $this->message1[]='(You must add a file!!!)';
            return $this->message1;
        }elseif(!$file['error']===0) {
            $this->message1[] = '(There is a error!!!)';
            return $this->message1;
        }elseif($file['size']>=1000000){
            $this->message1[] = '(This file is too large!!!)';
            return $this->message1;
        }elseif (!empty($_POST)) {
            if(empty($_POST['product_name'])) {
                $this->message2[] = '(What`s name of your product!!!)';
                return $this->message2;
            } elseif (empty($_POST['product_price'])) {
                $this->message3[] = '(What`s price of your product!!!)';
                return $this->message3;
            } elseif (empty($_POST['category_id'])) {
                $this->message4[] = '(What`s category id of your product!!!)';
                return $this->message4;
            }else{

                $directory=$this->parameters['root_folder'];
                move_uploaded_file($file['tmp_name'], $directory.'/assets/images/'. $file['name']);
                $object=new ProductRepository();
                $object->insertProduct($_POST['product_name'], $_POST['product_price'], $_FILES['image']['name'], $_POST['category_id']);
                $this->mesage[]='(Successfully added product!!!)';
                return $this->mesage;
            }
        }
    }
    public function addCategory()
    {
        if (!empty($_POST) ) {
            if (empty($_POST['category_name'])) {
                $this->message1[] = '(What`s name of your category!!!)';
                return $this->message1;
            } else {
                $object=new ProductRepository();
                $object->insertCategory($_POST['category_name']);
                $this->message2[] = '(successfully added category!!!)';
                return $this->message2;
            }
        }
    }
    public function AdminUpdateProduct($id)
    {
        $a=[];
        if(isset($_POST['upload'])) {

            if (empty($_POST['product_name'])) {
                $this->message1[] = 'What`s name of your product';
                return $this->message1;
            } elseif (empty($_POST['product_price'])) {
                $this->message2[] = 'What`s price of your product';
                return $this->message2;
            } elseif (isset($_FILES['image']['name']) && $_FILES['image']['name']!=="") {
                $sql = $this->pdo->query("select images from product where id='$id'");
                $products = $sql->fetchAll();
                $a[]=$products[0]['images'];
                $b=implode($a);
                    $directory=require "../dirname.php";
                    unlink($directory."/assets/images/$b");
                    move_uploaded_file($_FILES['image']['tmp_name'], $directory."/assets/images/" . $_FILES['image']['name']);
                    $object=new ProductRepository();
                    $object->updateProduct($id, $_FILES['image']['name'], $_POST['product_name'], $_POST['product_price'], $_POST['category_id']);
                    $this->mesage[] = 'Successful update';
                    return $this->mesage;
            }else{
                $object=new ProductRepository();
                $object->updateProduct1($id,$_POST['product_name'], $_POST['product_price'], $_POST['category_id']);
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
            $a[]=$products[0]['images'];
            $b=implode($a);
                unlink($directory."/assets/images/$b");
                $object=new ProductRepository();
                $object->deleteProduct($id);
                header(sprintf("Location:%s?page=product_list", $_SERVER['SCRIPT_NAME']));

        }
    }
    public function AdminUpdateCategory()
    {
        if(!isset($_POST)) {
            $this->mesage;
            return $this->mesage;
        }elseif (empty($_POST['new_name'])){
            $this->message1[]='What`s name of your category!!!';
        }else{
            $object=new ProductCategoryRepository();
            $object->updateCategory($_POST['new_name'],$_POST['category_name']);
            $this->mesage[]='Successful update!!!';
            return $this->mesage;
        }
    }
    public function AddUser(){
        $Repository=new UserRepository();
        if($_SERVER['REQUEST_METHOD']!=="POST") return $this->messages;

        if(empty($_POST['firstname'])) {
            $this->message1[] = 'What`s your firstname';
            return $this->message1;
        }elseif (empty($_POST['lastname'])){
            $this->message2[]='What`s your lastname';
            return $this->message2;
        }elseif (empty($_POST['username'])){
            $this->message3[]='Enter your username';
            return $this->message3;
        }elseif ($Repository->checkIfUsernameExists($_POST['username'])){
            $this->message3[]='This username is busy';
            return $this->message3;
        }elseif (empty($_POST['email'])){
            $this->message4[]='Enter your Email';
            return $this->message4;
        }elseif ($Repository->checkIfEmailExists($_POST['email'])){
            $this->message4[]='There is user with this email';
            return$this->message4;
        }elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $this->message4[]='This email is not valid';
            return $this->message4;
        }elseif (empty($_POST['password'])){
            $this->message5[]='What`s your password';
            return $this->message5;
        }elseif (strlen($_POST['password'])<6){
            $this->message5[]="The password must be less than five characters long";
            return$this->message5;
        }elseif (!preg_match("#[0-9]+#",$_POST['password'])){
            $this->message5[]='The password must contain at least one number';
            return $this->message5;
        }elseif(!preg_match("#[A-Z]+#",$_POST['password'])) {
            $this->message5[]='The password must contain at least one uppercase letter';
            return $this->message5;
        }elseif(!preg_match("#[a-z]+#",$_POST['password'])){
            $this->message5[]='The password must contain at least one lowercase letter';
            return $this->message5;
        }else{
            $Repository->insertUser($_POST['firstname'],$_POST['lastname'],$_POST['username'],$_POST['email'],$_POST['password']);
            $this->messages[] = 'Successfully Registered';
            header(sprintf("Location:%s?page=login",$_SERVER['SCRIPT_NAME']));
            return $this->messages;
        }

    }
    public function LoginUser(){
        $Repository=new UserRepository();
        if($_SERVER['REQUEST_METHOD']!=="POST") return $this->messages;
        if(empty($_POST['username'])){
            $this->message1[]="What`your username!!!";
            return $this->message1;
        }elseif (!$Repository->checkIfUsernameExists($_POST['username'])){
            $this->message1[]='Username wrong!!!';
            return $this->message1;
        }elseif (empty($_POST['password'])){
            $this->message2[]="What`s your password!!!";
            return $this->message2;
        }elseif (!$Repository->checkIfPasswordExists($_POST['password'])){
            $this->message2[]="Wrong password!!!";
            return $this->message2;
        }else{

            $user=$Repository->getUserByUsername($_POST['username']);
            $this->messages[]="You are successfully logged in!!!";
            $_SESSION['username']=$_POST['username'];
            $_SESSION['user_data']=$user;

            header(sprintf("Location:%s?page=index",$_SERVER['SCRIPT_NAME']));
            return $this->messages;
        }
    }

    public function likes(){
        $this->mesage='';
        $this->LikeRepository=new LikesRepository();
        if(isset($_POST['like'])){
            if(isset($_SESSION['username'])){
                if(!$this->LikeRepository->checkIfLikeExist($_GET['id'],$_SESSION['username'])){
                    $this->LikeRepository->insertLike();
                    $this->mesage='You like this product';
                    return $this->mesage;
                }else{
                    $this->LikeRepository->deleteLike();
                    $this->mesage='Do you like this product?';
                    return $this->mesage;
                }

            }else{
                $this->mesage="You must be logged in";
                return $this->mesage;
            }
        }
    }
    public function submittQuantity(){
        if(!isset($_POST['submitt'])){
            $quantity=0;
        }else{
            $quantity=$_POST['kolicina'];
        }
        return $quantity;
    }
    public function postComment($username)
    {
        $this->messages = '';
            if (isset($_SESSION['username'])) {
                if (!empty($_POST['textarea'])) {
                    $this->CommentRepository->insertComment($username, $_POST['date'], $_POST['textarea'], $_POST['product_id']);
                }
            } else {
                $this->messages = 'You must be logged in!!!';
                return $this->messages;
            }
    }

    public function commentLikes($commentId,$username){

            if(isset($_SESSION['username'])){
                if(!$this->LikeRepository->checkIfCommentLikeExist($commentId,$username)){
                    $this->LikeRepository->insertCommentLike($commentId,$username);

                }else{
                    $this->LikeRepository->updateCommentLike($commentId,$username);
                }
            }
    }
    public function commentUnlikes($commentId,$username){

        if(isset($_SESSION['username'])){
            if(!$this->LikeRepository->checkIfCommentLikeExist($commentId,$username)){
                $this->LikeRepository->insertCommentUnlike($commentId,$username);
            }else{
                $this->LikeRepository->updateCommentUnlike($commentId,$username);
            }
        }
    }
    public function likeProduct($productId,$username){

        if(isset($_SESSION['username'])){
            if(!$this->LikeRepository->checkIfProductLikeExist($productId,$username) && !$this->LikeRepository->checkIfMeUnlikeProduct($productId,$username)){
                $this->LikeRepository->insertProductLike($productId,$username);
            }else{
                $this->LikeRepository->updateProductLike($productId,$username);
            }
        }
    }
    public function unlikeProduct($productId,$username){
        if(isset($_SESSION['username'])){
            if(!$this->LikeRepository->checkIfMeUnlikeProduct($productId,$username) && !$this->LikeRepository->checkIfProductLikeExist($productId,$username)){
                $this->LikeRepository->insertProductUnlike($productId,$username);
            }else{
                $this->LikeRepository->updateProductUnlike($productId,$username);
            }
        }
    }

}