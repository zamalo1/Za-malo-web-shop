<?php


namespace App\Services;


use App\Entity\Product;

class Session
{
    public function isUserLogged()
    {
         return isset($_SESSION['username']);
    }

    public function addToCart(Product $product)
    {
        if(!isset($_SESSION['cart'])){
            $_SESSION['cart']=[];
        }
        $_SESSION['cart'][$product->getId()]=$product;
    }

    public function removeFromCart(Product $product)
    {
        if(isset($_SESSION['cart'][$product->getId()])){
            unset($_SESSION['cart'][$product->getId()]);
        }
    }
}