<?php


namespace App\Services;


use App\Entity\Product;

class Session
{
    public function isUserLogged()
    {
         return isset($_SESSION['username']);
    }

    public function get($key)
    {
       return $_SESSION[$key]??"";
    }

    public function unsetSession($key)
    {
        if(isset($_SESSION[$key]))
        {
            unset($_SESSION[$key]);
        }
    }

    public function addToCartSession(Product $product)
    {
        if(!isset($_SESSION['cart'])){
            $_SESSION['cart']=[];
        }
        $_SESSION['cart'][$product->getId()]=$product;
    }

    public function removeFromCartSession(Product $product,$key)
    {
        if(isset($_SESSION[$key][$product->getId()])){
            unset($_SESSION[$key][$product->getId()]);
        }
    }
    public function sessionSum(Product $product){
        if(!isset($_SESSION['ukupno'])){
            $_SESSION['ukupno']=[];
        }
        $_SESSION['ukupno'][$product->getId()]=$product->getQuantity()*$product->getPrice();
    }
    public function emptySession($key){
        $_SESSION[$key]=empty($_SESSION[$key]);
    }

}