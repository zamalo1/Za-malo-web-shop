<?php


namespace App\Controller;

use App\Abstractions\AbstractController;
use App\Entity\Comment;
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
        $products=$this->productsRepository->getProduct();
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
        $categories = $this->categoryRepository->getAllCategories();
        $comments=$this->commentRepository->getCommentsById($_GET['id']);
        $productLikes=$this->productsRepository->findProductById($_GET['id']);
        return IncludeTemplate::includeTemplateFile('product_details.php', ['products' => $products, 'categories' => $categories,'productLikes'=>$productLikes,'comments'=>$comments]);
    }
    public function commentLike()
    {
        $user=$this->container->getUser();
        $existLike=$this->likeRepositoty->checkIfMeLikeComment($_POST['commentId'],$user->getUserName());
        $existUnlike=$this->likeRepositoty->checkIfMeUnlikeComment($_POST['commentId'],$user->getUserName());
        $this->engine->commentLikes($_POST['commentId'],$user->getUserName());
        $array=['existLike'=>$existLike,'existUnlike'=>$existUnlike];
        echo json_encode($array);
    }
    public function commentUnlike()
    {
        $user=$this->container->getUser();
        $unlikeExist=$this->likeRepositoty->checkIfMeUnlikeComment($_POST['commentId'],$user->getUsername());
        $likeExist=$this->likeRepositoty->checkIfMeLikeComment($_POST['commentId'],$user->getUserName());
        $this->engine->commentUnlikes($_POST['commentId'],$user->getUserName());
        $data=['existUnlike'=>$unlikeExist,'existLike'=>$likeExist];
        echo json_encode($data);
    }
    public function productLikes()
    {
        $user=$this->container->getUser();
        $existLike=$this->likeRepositoty->checkIfMeLikeProduct($_POST['productId'],$user->getUserName());
        $existUnlike=$this->likeRepositoty->checkIfMeUnlikeProduct($_POST['productId'],$user->getUserName());
        $this->engine->likeProduct($_POST['productId'],$user->getUserName());
        $message=$this->engine->message2;
        $data=['existLike'=>$existLike,'existUnlike'=>$existUnlike,'msg'=>$message];
        echo json_encode($data);

    }
    public function productUnlikes()
    {
        $user=$this->container->getUser();
        $existUnlike=$this->likeRepositoty->checkIfMeUnlikeProduct($_POST['productId'],$user->getUserName());
        $existLike=$this->likeRepositoty->checkIfMeLikeProduct($_POST['productId'],$user->getUserName());
        $this->engine->unlikeProduct($_POST['productId'],$user->getUserName());
        $message=$this->engine->message2;
        $data=['existUnlike'=>$existUnlike,'existLike'=>$existLike,'msg'=>$message];
        echo json_encode($data);
    }
    public function productComment(){
        $user=$this->container->getUser();
        $this->engine->postComment($user->getUserName());
    }
}