<?php


namespace App\Repository;
use App\Entity\Comment;
use App\Utils\DatabaseConnection;

class CommentRepository
{
    private $pdo;

    public function __construct()
    {
        $this->pdo=DatabaseConnection::getConnection();
    }

    public function insertComment($username,$date,$text,$productId)
    {
        $query=$this->pdo->query("INSERT INTO comment (username, date, text,product_id) VALUE ('$username', '$date', '$text','$productId')");
        return $query;
    }
    public function getCommentsById($id){

        $commentObjects=[];
        $stmt=$this->pdo->query("SELECT * FROM comment   WHERE product_id='$id'");
        $comments=$stmt->fetchAll();
        foreach ($comments as $comment){
            $commentObject=new Comment($comment);
            $likes=$this->pdo->query(sprintf("SELECT * FROM like_comment WHERE comment_id=%s AND type='like' ",$commentObject->getId()))->fetchAll(\PDO::FETCH_ASSOC);
            $dislikes=$this->pdo->query(sprintf("SELECT * FROM like_comment WHERE comment_id=%s AND type='unlike' ",$commentObject->getId()))->fetchAll(\PDO::FETCH_ASSOC);
            if(in_array($_SESSION['user_data']['username']??"",array_column($likes,'username') )){
                $commentObject->setUserLikedThisComment(true);
            }elseif (in_array($_SESSION['user_data']['username']??"",array_column($dislikes,'username') )){
                $commentObject->setUserUnlikedThisComment(true);
            }

            $commentObject->setLikes($likes);
            $commentObject->setDislikes($this->pdo->query(sprintf("SELECT * FROM like_comment WHERE comment_id=%s AND type='unlike' ",$commentObject->getId()))->fetchAll(\PDO::FETCH_ASSOC));
            $commentObjects[]= $commentObject;
        }
        return $commentObjects;
    }

}