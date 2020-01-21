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
    private $engine;


    public function __construct($container)
    {
        parent::__construct($container);
        $this->productsRepository=new ProductRepository();
        $this->categoryRepository=new ProductCategoryRepository();
        $this->engine=$this->container->getEngine();
    }
    public function registration(){

        $this->engine->AddUser();
        $mesage=$this->engine->messages;
        $FNMessage=$this->engine->message1;
        $LNMessage=$this->engine->message2;
        $UNMessage=$this->engine->message3;
        $EmailMessage=$this->engine->message4;
        $PassMessage=$this->engine->message5;
        $categories=$this->categoryRepository->getAllCategories();
        return IncludeTemplate::includeTemplateFile('registration.php',['categories'=>$categories,'message'=>$mesage,'FNMessage'=>$FNMessage, 'LNMessage'=>$LNMessage,'UNMessage'=>$UNMessage,'EmailMessage'=>$EmailMessage,'PassMessage'=>$PassMessage
        ]);
    }
    public function login(){
        $this->engine->LoginUser();
        $message=$this->engine->messages;
        $UserMessage=$this->engine->message1;
        $PassMessage=$this->engine->message2;
        $categories=$this->categoryRepository->getAllCategories();
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

            $this->engine->AdminUpdateProduct($_GET['id']);
            $message1=$this->engine->message1;
            $message2=$this->engine->message2;
            $message=$this->engine->mesage;
            $produtById=$this->productsRepository->CheckProductById($_GET['id']);
            $allCategories = $this->categoryRepository->getAllCategories();
            return IncludeTemplate::includeTemplateFile('update_product.php', ['products'=>$produtById,'categories' => $allCategories,'name'=>$message1,'price'=>$message2,'message'=>$message
            ]);
    }
    public function UpdateCategory()
    {
        if(!$this->isLogged()) header(sprintf("Location:%s?page=login",$_SERVER['SCRIPT_NAME']));
        $this->engine->AdminUpdateCategory();
        $mesage=$this->engine->mesage;
        $newMessage=$this->engine->message1;
        $allCategories=$this->categoryRepository->getAllCategories();
        return IncludeTemplate::includeTemplateFile('update_category.php',['categories'=>$allCategories,'mesage'=>$mesage,'newMessage'=>$newMessage]);
    }
    public function deleteProduct()
    {
        if(!$this->isLogged()) header(sprintf("Location:%s?page=login",$_SERVER['SCRIPT_NAME']));
        $this->engine->AdminDeleteProduct($_GET['id']);
        $produtById=$this->productsRepository->CheckProductById($_GET['id']);
        return IncludeTemplate::includeTemplateFile('delete_product.php',['products'=>$produtById]);
    }



}