<?php
namespace App\Repository;


use App\Utils\DatabaseConnection;
use http\Exception\InvalidArgumentException;

class LikesRepository
{
    private $pdo;

    public function __construct()
    {
        $this->pdo=DatabaseConnection::getConnection();
    }

    public function checkIfLikeExist($productID,$username){
        $stmt=$this->pdo->prepare("Select id FROM likes where product_id=? AND username=?");
        $stmt->execute([$productID,$username]);
        $row=$stmt->fetchAll();
        if(!empty($row))
        {
            return true;
        }
        else{
            return false;
        }
    }

    public function insertLike(){
        $id=$_GET['id'];
        $username=$_SESSION['username'];
        $stmt=$this->pdo->query("INSERT INTO likes (product_id,username) VALUE ('$id','$username')");
        return $stmt;
    }

    public function deleteLike(){
        $username=$_SESSION['username'];
        $id=$_GET['id'];
        $stmt=$this->pdo->query("DELETE FROM likes WHERE product_id='$id' AND username='$username'");
            return $stmt;
    }

    public function countLikes($id){
        $stmt=$this->pdo->query("SELECT id FROM likes WHERE product_id='$id'");
        $product=$stmt->fetchAll();
        return count($product);
    }

    public function checkIfCommentLikeExist($commentId,$username){
        $stmt=$this->pdo->prepare("Select id FROM like_comment where comment_id=? AND username=? ");
        $stmt->execute([$commentId,$username]);
        $row=$stmt->fetchAll();
        if(!empty($row))
        {
            return true;
        }
        else{
            return false;
        }
    }

    public function insertCommentLike($commentId,$username){
        $type='like';
        $stmt=$this->pdo->query("INSERT INTO like_comment (comment_id,username,type) VALUE ('$commentId','$username','$type')");
        return $stmt;
    }

    public function insertCommentUnlike($commentId,$username)
    {
        $type = 'unlike';
        $stmt = $this->pdo->query("INSERT INTO like_comment (comment_id,username,type) VALUE ('$commentId','$username','$type')");
        return $stmt;
    }
    public function updateCommentLike($commentId,$username)
    {
        $type='like';
        $query=$this->pdo->query("UPDATE like_comment SET type='$type' WHERE comment_id='$commentId' AND  username='$username'");
        return $query;
    }

    public function updateCommentUnlike($commentId,$username)
    {
        $type='unlike';
        $query=$this->pdo->query("UPDATE like_comment SET type='$type' WHERE comment_id='$commentId' and  username='$username'");
        return $query;
    }
    public function checkIfMeLikeComment($commentId,$username){
        $type='like';
        $stmt=$this->pdo->prepare("Select id FROM like_comment where comment_id=? AND username=? AND type=?");
        $stmt->execute([$commentId,$username,$type]);
        $row=$stmt->fetchAll();
        if(!empty($row))
        {
            return true;
        }
        else{
            return false;
        }
    }

    public function checkIfMeUnlikeComment($commentId,$username){
        $type='unlike';
        $stmt=$this->pdo->prepare("Select id FROM like_comment where comment_id=? AND username=? AND type=?");
        $stmt->execute([$commentId,$username,$type]);
        $row=$stmt->fetchAll();
        if(!empty($row))
        {
            return true;
        }
        else{
            return false;
        }
    }
    public function checkIfProductLikeExist($productId,$username){
        $stmt=$this->pdo->prepare("Select id FROM likes where product_id=? AND username=? ");
        $stmt->execute([$productId,$username]);
        $row=$stmt->fetchAll();
        if(!empty($row))
        {
            return true;
        }
        else{
            return false;
        }
    }
    public function checkIfMeLikeProduct($productId,$username){
        $type='like';
        $stmt=$this->pdo->prepare("Select id FROM likes where product_id=? AND username=? AND type=?");
        $stmt->execute([$productId,$username,$type]);
        $row=$stmt->fetchAll();
        if(!empty($row))
        {
            return true;
        }
        else{
            return false;
        }
    }
    public function checkIfMeUnlikeProduct($productId,$username){
        $type='unlike';
        $stmt=$this->pdo->prepare("Select id FROM likes where product_id=? AND username=? AND type=?");
        $stmt->execute([$productId,$username,$type]);
        $row=$stmt->fetchAll();
        if(!empty($row))
        {
            return true;
        }
        else{
            return false;
        }
    }
    public function insertProductLike($productId,$username){
        $type='like';
        $stmt=$this->pdo->query("INSERT INTO likes (product_id,username,type) VALUE ('$productId','$username','$type')");
        return $stmt;
    }
    public function insertProductUnlike($productId,$username)
    {
        $type = 'unlike';
        $stmt = $this->pdo->query("INSERT INTO likes (product_id,username,type) VALUE ('$productId','$username','$type')");
        return $stmt;
    }
    public function updateProductLike($productId,$username)
    {
        $type='like';
        $query=$this->pdo->query("UPDATE likes SET type='$type' WHERE product_id='$productId' AND  username='$username'");
        return $query;
    }
    public function updateProductUnlike($productId,$username)
    {
        $type='unlike';
        $query=$this->pdo->query("UPDATE likes SET type='$type' WHERE product_id='$productId' AND  username='$username'");
        return $query;
    }
}