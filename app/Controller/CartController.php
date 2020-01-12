<?php


namespace App\Controller;

use App\Entity\Product;
use App\Services\Session;
use App\Abstractions\AbstractController;
use App\Repository\ProductCategoryRepository;
use App\Repository\ProductRepository;
use App\Services\Engine;
use App\Utils\IncludeTemplate;

class CartController extends AbstractController
{
    private $productsRepository;
    private $categoryRepository;

    public function __construct($container)
    {
        parent::__construct($container);
        $this->productsRepository=new ProductRepository();
        $this->categoryRepository=new ProductCategoryRepository();
    }

    public function add_to_cart($id){
        $product=$this->productsRepository->CheckProductById1($id);
        $session=new Session();
        $session->addToCartSession($product);
        header(sprintf("Location:%s?page=shopping_cart", $_SERVER['SCRIPT_NAME']));
    }
    public function shoppingCart(){
        $categories=$this->categoryRepository->getAllCategories();
        $products=$_SESSION['cart'];
        return IncludeTemplate::includeTemplateFile('cart.php',['categories'=>$categories,'products'=>$products,]);
    }
    public function removeFromCart($id){
        $product=$this->productsRepository->CheckProductById1($id);
        $session=new Session();
        $session->removeFromCartSession($product);
        header(sprintf("Location:%s?page=shopping_cart", $_SERVER['SCRIPT_NAME']));
    }
    public function emptyCart(){
        if(isset($_SESSION['cart'])){
            if(!empty($_SESSION['cart'])) {
                $_SESSION['cart'] = empty($_SESSION['cart']);
            }
        }
        header(sprintf("Location:%s?page=shopping_cart", $_SERVER['SCRIPT_NAME']));
    }
}