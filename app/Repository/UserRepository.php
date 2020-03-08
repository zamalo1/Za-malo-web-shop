<?php


namespace App\Repository;
use App\Utils\DatabaseConnection;

class UserRepository
{
    private $pdo;


    public function __construct()
    {
        $this->pdo=DatabaseConnection::getConnection();
    }


    public function insertUser($firstname,$lastname,$username,$email,$password)
    {
        $stmt=$this->pdo->prepare("Insert Into user (firstname,lastname,username,email,password) values (?,?,?,?,?)");
        $stmt->execute([$firstname,$lastname,$username,$email,$password]);
    }


    public function checkIfUsernameExists($username)
    {
    $stmt=$this->pdo->prepare("Select id FROM user where username=?");
    $stmt->execute([$username]);
    $row=$stmt->fetchAll();
    if(!empty($row))
    {
        return true;
    }
    else{
        return false;
    }
}
    public function checkIfEmailExists($email)
    {
        $stmt=$this->pdo->prepare("Select id FROM user where email=?");
        $stmt->execute([$email]);
        $row=$stmt->fetchAll();
        if(!empty($row))
        {
            return true;
        }
        else{
            return false;
        }
    }
    public function checkIfPasswordExists($password)
    {
        $stmt=$this->pdo->prepare("Select id FROM user where password=?");
        $stmt->execute([$password]);
        $row=$stmt->fetchAll();
        if(!empty($row))
        {
            return true;
        }
        else{
            return false;
        }
    }

    public function getUserByUsername($username)
    {
        $stmt=$this->pdo->prepare("Select * FROM user where username=?");
        $stmt->execute([$username]);
        $row=$stmt->fetch(\PDO::FETCH_ASSOC);
        return $row;
    }

}

