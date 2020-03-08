<?php


namespace App\Controller;

use App\Abstractions\AbstractController;
use App\Repository\CommentRepository;
use App\Repository\LikesRepository;
use App\Repository\ProductCategoryRepository;
use App\Repository\ProductRepository;
use App\Services\ServiceContainer;
use App\Utils\IncludeTemplate;

class ProductController extends AbstractController
{

    private $productsRepository;
    private $categoryRepository;
    private $engine;
    private $session;
    private $likeRepositoty;
    private $commentRepository;
    public $message='like this post';

    public function __construct(ServiceContainer $container)
    {
        parent::__construct($container);
        $this->productsRepository=new ProductRepository();
        $this->categoryRepository=new ProductCategoryRepository();
        $this->likeRepositoty=new LikesRepository();
        $this->commentRepository=new CommentRepository();
        $this->session=$container->getSession();
        $this->engine=$container->getEngine();
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
        $nameMessage=[];
        $priceMessage=[];
        $categoryMessage=[];
        if(isset($_POST['upload'])) {
            $this->engine->addProduct($_FILES['image']);
            $mesage = $this->engine->mesage;
            $fileMessage = $this->engine->message1;
            $nameMessage = $this->engine->message2;
            $priceMessage = $this->engine->message3;
            $categoryMessage = $this->engine->message4;
        }
        $allCategories=$this->categoryRepository->getAllCategories();
        return IncludeTemplate::includeTemplateFile('add_product.php',['categories'=>$allCategories,'nMessage'=>$nameMessage,'pMessage'=>$priceMessage, 'cMessage'=>$categoryMessage,'mesage'=>$mesage,'fileMessage'=>$fileMessage
        ]);
    }
    public function AddCategory()
    {
        if(!$this->isLogged()) header(sprintf("Location:%s?page=login",$_SERVER['SCRIPT_NAME']));
        $this->engine->addCategory();
        $finishMessage=$this->engine->message2;
        $categoryMessage=$this->engine->message1;
        return IncludeTemplate::includeTemplateFile('add_category.php',['categoryMessage'=>$categoryMessage,'newMessage'=>$finishMessage]);
    }
    public function productDetails($id)
    {
            $this->likeRepositoty->countLikes($id);
            $this->engine->likes();
            $products = $this->productsRepository->CheckProductById($id);
            $product = $this->productsRepository->CheckProductById1($id);
            $quantity=$this->engine->submittQuantity();
            $product->setQuantity($quantity);
            $this->session->sessionSum($product);
            $this->session->addToCartSession($product);
            $categories = $this->categoryRepository->getAllCategories();
            $message=$this->engine->mesage;
            $this->engine->postComment();
            $comments=$this->commentRepository->getCommentsById($_GET['id']);
            $message1=$this->engine->messages;
            return IncludeTemplate::includeTemplateFile('product_details.php', ['products' => $products, 'categories' => $categories,'comments'=>$comments,'message'=>$message,'message1'=>$message1]);
    }
    public function likedTheComment(){
        $this->engine->commentLikes();
        $productId=$_GET['product_id'];

        header(sprintf("Location:%s?page=product_details&id=$productId",$_SERVER['SCRIPT_NAME']));



    }

    public function commentLike()
    {
        $user=$this->container->getUser();
        $a=$this->likeRepositoty->checkIfMeLikeComment($_POST['commentId'],$user->getUserName());
        $b=$this->likeRepositoty->checkIfMeUnlikeComment($_POST['commentId'],$user->getUserName());
        $this->engine->commentLikes($_POST['commentId'],$user->getUserName());
        $likesQuantity=$this->likeRepositoty->getCommentLikes($_POST['commentId']);
        $array=['existLike'=>$a,'existUnlike'=>$b,'likesQuantity'=>$likesQuantity];
        echo json_encode($array);
    }
    public function commentUnlike()
    {
        $user=$this->container->getUser();
        $b=$this->likeRepositoty->checkIfMeUnlikeComment($_POST['commentId'],$user->getUsername());
        $a=$this->likeRepositoty->checkIfMeLikeComment($_POST['commentId'],$user->getUserName());
        $this->engine->commentUnlikes($_POST['commentId'],$user->getUserName());
        $array=['existUnlike'=>$b,'existLike'=>$a];
        echo json_encode($array);
    }
    public function postAComment(){

        $this->engine->postComment();
        $message=$this->engine->messages;
        $getCommentById=$this->commentRepository->getCommentsById1($_POST['product_id']);
        $a=['message'=>$message,'comment_by_id'=>$getCommentById];
        echo json_encode($a);
    }


}