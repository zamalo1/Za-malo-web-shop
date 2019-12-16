<?php


namespace App\Repository;
use App\Utils\DatabaseConnection;

class UserRepository
{
    private $pdo;
    public $messages=[];
    public $firstnameMessage=[];
    public $lastnameMessage=[];
    public $UsernameMessage=[];
    public $emailMessage=[];
    public $PasswordMessage=[];


    public function __construct()
    {
        $this->pdo=DatabaseConnection::getConnection();
    }

    public function AddUser(){
        if($_SERVER['REQUEST_METHOD']!=="POST") return $this->messages;

        if(empty($_POST['firstname'])) {
            $this->firstnameMessage[] = 'What`s your firstname';
            return $this->firstnameMessage;
        }elseif (empty($_POST['lastname'])){
            $this->lastnameMessage[]='What`s your lastname';
            return $this->lastnameMessage;
        }elseif (empty($_POST['username'])){
            $this->UsernameMessage[]='Enter your username';
            return $this->UsernameMessage;
        }elseif ($this->checkIfUsernameExists($_POST['username'])){
            $this->UsernameMessage[]='This username is busy';
            return $this->UsernameMessage;
        }elseif (empty($_POST['email'])){
            $this->emailMessage[]='Enter your Email';
            return $this->emailMessage;
        }elseif ($this->checkIfEmailExists($_POST['email'])){
            $this->emailMessage[]='There is user with this email';
            return$this->emailMessage;
        }elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $this->emailMessage[]='This email is not valid';
            return $this->emailMessage;
        }elseif (empty($_POST['password'])){
            $this->PasswordMessage[]='What`s your password';
            return $this->PasswordMessage;
        }elseif (strlen($_POST['password'])<6){
            $this->PasswordMessage[]="The password must be less than five characters long";
            return$this->PasswordMessage;
        }elseif (!preg_match("#[0-9]+#",$_POST['password'])){
            $this->PasswordMessage[]='The password must contain at least one number';
            return $this->PasswordMessage;
        }elseif(!preg_match("#[A-Z]+#",$_POST['password'])) {
            $this->PasswordMessage[]='The password must contain at least one uppercase letter';
            return $this->PasswordMessage;
        }elseif(!preg_match("#[a-z]+#",$_POST['password'])){
            $this->PasswordMessage[]='The password must contain at least one lowercase letter';
            return $this->PasswordMessage;
        }else{
            $this->insertUser($_POST['firstname'],$_POST['lastname'],$_POST['username'],$_POST['email'],$_POST['password']);
            $this->messages[] = 'Successfully Registered';
            header(sprintf("Location:%s?page=login",$_SERVER['SCRIPT_NAME']));
            return $this->messages;
        }

    }


    public function LoginUser(){
        if($_SERVER['REQUEST_METHOD']!=="POST") return $this->messages;
        if(empty($_POST['username'])){
            $this->UsernameMessage[]="What`your username!!!";
            return $this->UsernameMessage;
        }elseif (!$this->checkIfUsernameExists($_POST['username'])){
            $this->UsernameMessage[]='Username wrong!!!';
            return $this->UsernameMessage;
        }elseif (empty($_POST['password'])){
            $this->PasswordMessage[]="What`s your password!!!";
            return $this->PasswordMessage;
        }elseif (!$this->checkIfPasswordExists($_POST['password'])){
            $this->PasswordMessage[]="Wrong password!!!";
            return $this->PasswordMessage;
        }else{
            $this->messages[]="You are successfully logged in!!!";
            $_SESSION['username']=$_POST['username'];
            return $this->messages;
        }
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

}

