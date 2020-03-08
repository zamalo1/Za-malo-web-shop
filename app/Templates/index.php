<html>
<?php
    include ("header.php");

?>
<body>
    <main>
        <?php
        /*** @var $product Product */use App\Entity\Product;?>

            <div class="row">
                <?php foreach ($templateArray['products'] as $product){?>
                    <div class="elrow">
                        <div id="mazalo"> <img src="../assets/images/<?=$product->getImages()?>" width="210px" height="210px"></div>
                        <p id="p1"><?=$product->getName()?></p>
                        <p id="cena1"><b>Cena: <?=$product->getPrice()?> rsd</b></p><br>
                        <form action="http://localhost/HtmlCSS/webstore/kernel/index.php?page=add_to_cart&id=<?=$product->getId()?>" method="post">
                            <p id="likeMessage"><?php
                                if(isset($_SESSION['username'])){
                            $a=new \App\Repository\LikesRepository();
                            $username=$_SESSION['username'];
                            if(!$a->checkIfLikeExist($product->getId(),$username)){
                                echo '';
                            }else{
                                echo 'You like this product?';
                            }
                        }else{
                            echo 'Log in to like this product?';
                        }
                                ?></p>
                            <button id="likeProduct" name="like" ><img src="../assets/images/srce.png"></button>
                            <input type="text" value="<?php $a=new \App\Repository\LikesRepository();
                            echo $a->countLikes($product->getId());?>" name="likeQ" id="likeQ" readonly="readonly">
                            <input id="kol" type="number" value="1" min="1" max="10" name="kolicina">
                            <button type="submit" name="add">Dodaj u korpu</button>
                            <button><a href="http://localhost/HtmlCSS/webstore/kernel/index.php?page=product_details&id=<?=$product->getId()?>">Detaljnije</a></button>
                        </form>

                    </div>
                <?php } ?>
            </div>


    </main>
    <?php
    include ("footer.php");

    ?>
    <script
            src="https://code.jquery.com/jquery-3.4.1.js"
            integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
            crossorigin="anonymous">

    </script>
<script>


</script>

</body>
</html>