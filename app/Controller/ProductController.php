<?php


namespace App\Controller;

use App\Abstractions\AbstractController;
use App\Repository\ProductCategoryRepository;
use App\Repository\ProductRepository;
use App\Services\Session;
use App\Utils\IncludeTemplate;
use App\Services\Engine;
use App\Entity\Product;

class ProductController extends AbstractController
{

    private $productsRepository;
    private $categoryRepository;

    public function __construct($container)
    {
        parent::__construct($container);
        $this->productsRepository=new ProductRepository();
        $this->categoryRepository=new ProductCategoryRepository();
    }

    public function index()
    {
        $products=$this->productsRepository->getProductsByType();
        $categories=$this->categoryRepository->getAllCategories();
        $content=IncludeTemplate::includeTemplateFile('index.php',[
            'products'=>$products,
            'categories'=>$categories
        ]);

        return $content;
    }

    public function productByCategory($id)
    {
        $products=$this->productsRepository->getProductsByCategory($id);
        $categories=$this->categoryRepository->getAllCategories();
        $content=IncludeTemplate::includeTemplateFile('index.php',[
            'products'=>$products,
            'categories'=>$categories
        ]);

        return $content;
    }
    public function AddProduct()
    {
        if(!$this->isLogged()) header(sprintf("Location:%s?page=login",$_SERVER['SCRIPT_NAME']));
        $mesage=[];
        $fileMessage=[];
        $imageMessage=[];
        $nameMessage=[];
        $priceMessage=[];
        $categoryMessage=[];
        if(isset($_POST['upload'])) {
            $object = new Engine();
            $object->addProduct($_FILES['image']);
            $mesage = $object->mesage;
            $fileMessage = $object->message1;
            $nameMessage = $object->message2;
            $priceMessage = $object->message3;
            $categoryMessage = $object->message4;
        }
        $allCategories=$this->categoryRepository->getAllCategories();
        return IncludeTemplate::includeTemplateFile('add_product.php',['categories'=>$allCategories,'nMessage'=>$nameMessage,'pMessage'=>$priceMessage, 'cMessage'=>$categoryMessage,'mesage'=>$mesage,'fileMessage'=>$fileMessage
        ]);
    }
    public function AddCategory()
    {
        if(!$this->isLogged()) header(sprintf("Location:%s?page=login",$_SERVER['SCRIPT_NAME']));
        $object=new Engine();
        $object->addCategory();
        $finishMessage=$object->message2;
        $categoryMessage=$object->message1;
        return IncludeTemplate::includeTemplateFile('add_category.php',['categoryMessage'=>$categoryMessage,'newMessage'=>$finishMessage]);
    }



}