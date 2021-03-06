<?php


require __DIR__."/../vendor/autoload.php";
session_start();
use App\Controller\ProductController;
use App\Controller\AdminController;
use App\Controller\CartController;
use App\Services\ServiceContainer;

/**
 * Get parametar prosledjen u urlu i na osnovu njega biramo kontroler i pozivamo metodu koja ce generisati sadrzaj
 */

$configuration =require "../env.php" ;
if(isset($_GET['page'])) {
    if ($_GET['page'] == "index") {
        $controller = new ProductController(new ServiceContainer($configuration));
        $content = $controller->index();
    }

   elseif ($_GET['page']=='prod_by_category'){
       $controller=new ProductController(new ServiceContainer($configuration));
       $content=$controller->productByCategory($_GET['id']);
   }
    elseif ($_GET['page']=='admin_add_product'){
        $controller=new ProductController(new ServiceContainer($configuration));
        $content=$controller->AddProduct();
    }
    elseif ($_GET['page']=='admin_add_category'){
        $controller=new ProductController(new ServiceContainer($configuration));
        $content=$controller->AddCategory();
    }
    elseif ($_GET['page']=='registration'){
        $controller=new AdminController(new ServiceContainer($configuration));
        $content=$controller->registration();
    }
    elseif ($_GET['page']=='login'){
        $controller=new AdminController(new ServiceContainer($configuration));
        $content=$controller->login();
    }
    elseif ($_GET['page']=='admin_update_product'){
        $controller=new AdminController(new ServiceContainer($configuration));
        $content=$controller->UpdateProduct();
    }
    elseif ($_GET['page']=='admin_update_category'){
        $controller=new AdminController(new ServiceContainer($configuration));
        $content=$controller->UpdateCategory();
    }
    elseif ($_GET['page']=='product_list'){
        $controller= new AdminController(new ServiceContainer($configuration));
        $content=$controller->ProductList();
    }
    elseif ($_GET['page']=='admin_delete_product'){
        $controller= new AdminController(new ServiceContainer($configuration));
        $content=$controller->deleteProduct();
    }
    elseif ($_GET['page']=='logout'){
        $controller=new AdminController(new ServiceContainer($configuration));
        $content=$controller->logout();
    }
    elseif($_GET['page']=='add_to_cart'){
        $controller=new CartController(new ServiceContainer($configuration));
        $content=$controller->add_to_cart($_GET['id']);
    }elseif ($_GET['page']=='shopping_cart'){
        $controller=new CartController(new ServiceContainer($configuration));
        $content=$controller->shoppingCart();
    }
    elseif($_GET['page']=='remove_from_cart') {
        $controller = new CartController(new ServiceContainer($configuration));
        $content = $controller->removeFromCart($_GET['id']);
    }
    elseif ($_GET['page']=='empty_cart'){
        $controller = new CartController(new ServiceContainer($configuration));
        $content=$controller->emptyCart();
    }elseif ($_GET['page']=='product_details'){
        $controller=new ProductController(new ServiceContainer($configuration));
        $content=$controller->productDetails($_GET['id']);
    }elseif($_GET['page']=='product_like'){
        $controller=new ProductController(new ServiceContainer($configuration));
        $content=$controller->commentLike();
    }elseif($_GET['page']=='product_unlike'){
        $controller=new ProductController(new ServiceContainer($configuration));
        $content=$controller->commentUnlike();
    }elseif ($_GET['page']=='products_like'){
        $controller=new ProductController(new ServiceContainer($configuration));
        $content=$controller->productLikes();
    }elseif ($_GET['page']=='products_unlike'){
        $controller=new ProductController(new ServiceContainer($configuration));
        $content=$controller->productUnlikes();
    }elseif ($_GET['page']=='product_comments'){
        $controller=new ProductController(new ServiceContainer($configuration));
        $content=$controller->productComment();
    }
    echo $content;
}



