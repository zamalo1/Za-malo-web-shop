<?php


namespace App\Controller;
use App\Abstractions\AbstractController;
use App\Repository\ProductCategoryRepository;
use App\Services\Engine;
use App\Services\ServiceContainer;
use App\Utils\IncludeTemplate;
use App\Repository\UserRepository;
use App\Repository\ProductRepository;
use App\Utils\DatabaseConnection;


class AdminController extends AbstractController
{
    private $productsRepository;
    private $categoryRepository;


    public function __construct($container)
    {
        parent::__construct($container);
        $this->productsRepository=new ProductRepository();
        $this->categoryRepository=new ProductCategoryRepository();
    }
    public function registration(){

        $object=new ProductCategoryRepository();
        $InsertUser= new Engine();
        $InsertUser->AddUser();
        $mesage=$InsertUser->messages;
        $FNMessage=$InsertUser->message1;
        $LNMessage=$InsertUser->message2;
        $UNMessage=$InsertUser->message3;
        $EmailMessage=$InsertUser->message4;
        $PassMessage=$InsertUser->message5;
        $categories=$object->getAllCategories();
        return IncludeTemplate::includeTemplateFile('registration.php',['categories'=>$categories,'message'=>$mesage,'FNMessage'=>$FNMessage, 'LNMessage'=>$LNMessage,'UNMessage'=>$UNMessage,'EmailMessage'=>$EmailMessage,'PassMessage'=>$PassMessage
        ]);
    }
    public function login(){
        $object=new ProductCategoryRepository();
        $loginUser=new Engine();
        $loginUser->LoginUser();
        $message=$loginUser->messages;
        $UserMessage=$loginUser->message1;
        $PassMessage=$loginUser->message2;
        $categories=$object->getAllCategories();
        return IncludeTemplate::includeTemplateFile('login.php',['categories'=>$categories,'mesage'=>$message,'userMessage'=>$UserMessage,'passMessage'=>$PassMessage
        ]);
    }
    public function logout()
    {
        if($this->isLogged()){
            session_destroy();
            header(sprintf("Location:%s?page=login",$_SERVER['SCRIPT_NAME']));
        }
    }
    public function ProductList()
    {
        if(!$this->isLogged()) header(sprintf("Location:%s?page=login",$_SERVER['SCRIPT_NAME']));
        $products=$this->productsRepository->getProductsByType();
        return IncludeTemplate::includeTemplateFile('product_list.php',['products'=>$products]);
    }


    public function UpdateProduct()
    {
        if(!$this->isLogged()) header(sprintf("Location:%s?page=login",$_SERVER['SCRIPT_NAME']));
            $productRepository=new Engine();
            $productRepository->AdminUpdateProduct($_GET['id']);
            $message1=$productRepository->message1;
            $message2=$productRepository->message2;
            $message=$productRepository->mesage;
            $produtById=$this->productsRepository->CheckProductById($_GET['id']);
            $allCategories = $this->categoryRepository->getAllCategories();
            return IncludeTemplate::includeTemplateFile('update_product.php', ['products'=>$produtById,'categories' => $allCategories,'name'=>$message1,'price'=>$message2,'message'=>$message
            ]);
    }
    public function UpdateCategory()
    {
        if(!$this->isLogged()) header(sprintf("Location:%s?page=login",$_SERVER['SCRIPT_NAME']));
        $controler=new Engine();
        $controler->AdminUpdateCategory();
        $mesage=$controler->mesage;
        $newMessage=$controler->message1;
        $allCategories=$this->categoryRepository->getAllCategories();
        return IncludeTemplate::includeTemplateFile('update_category.php',['categories'=>$allCategories,'mesage'=>$mesage,'newMessage'=>$newMessage]);
    }
    public function deleteProduct()
    {
        if(!$this->isLogged()) header(sprintf("Location:%s?page=login",$_SERVER['SCRIPT_NAME']));
        $obect=new Engine();
        $obect->AdminDeleteProduct($_GET['id']);
        $produtById=$this->productsRepository->CheckProductById($_GET['id']);
        return IncludeTemplate::includeTemplateFile('delete_product.php',['products'=>$produtById]);
    }



}