<?php


namespace App\Controller;

use App\Repository\LikesRepository;
use App\Services\ServiceContainer;
use App\Services\Session;
use App\Abstractions\AbstractController;
use App\Repository\ProductCategoryRepository;
use App\Repository\ProductRepository;
use App\Utils\IncludeTemplate;

class CartController extends AbstractController
{
    private $likeRepository;
    private $productsRepository;
    private $categoryRepository;
    /**
     * @var Session
     */
    private $session;
    private $engine;

    public function __construct(ServiceContainer $container)
    {
        parent::__construct($container);
        $this->productsRepository=new ProductRepository();
        $this->categoryRepository=new ProductCategoryRepository();
        $this->likeRepository=new LikesRepository();
        $this->engine=$container->getEngine();
        $this->session=$container->getSession();
    }

    public function add_to_cart($id){
        $this->likeRepository->countLikes($_GET['id']);
        $this->engine->likes();
        $product=$this->productsRepository->CheckProductById1($id);
        $product->setQuantity($_GET['kolicina']);
        $this->session->sessionSum($product);
        $this->session->addToCartSession($product);
        header(sprintf("Location:%s?page=index", $_SERVER['SCRIPT_NAME']));
    }
    public function shoppingCart(){
        $categories=$this->categoryRepository->getAllCategories();
        $product=$this->session->get('cart');
        return IncludeTemplate::includeTemplateFile('cart.php',['categories'=>$categories,'products'=>$product]);
    }
    public function removeFromCart($id){
        $product=$this->productsRepository->CheckProductById1($id);
        $this->session->removeFromCartSession($product,'cart');
        $this->session->removeFromCartSession($product,'ukupno');
        header(sprintf("Location:%s?page=shopping_cart", $_SERVER['SCRIPT_NAME']));
    }
    public function emptyCart(){
        if($this->session->get('cart') && $this->session->get('ukupno')) {
            if (!empty($this->session->get('cart')) && !empty($this->session->get('ukupno'))) {
                $this->session->unsetSession('cart');
                $this->session->emptySession('ukupno');
                    }
                }

        header(sprintf("Location:%s?page=shopping_cart", $_SERVER['SCRIPT_NAME']));
    }
}