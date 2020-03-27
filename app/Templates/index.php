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
                            <p id="likeMessage"></p>
                            <div id="likesDiv">
                                <button class="likesButton <?=$product->isUserLikeThisProduct()?"productLiked":""?>" data-username="<?=$_SESSION['username']?? "" ?>" product-id="<?=$product->getId()?>" name="likesButton"><img src="../assets/images/like.jpg" width="20px" height="20px"></button>
                                <input class="likesQuantity <?=$product->isUserLikeThisProduct()?"quantityLiked":""?>" name="likesQuantity" value="<?=count($product->getLikes())?>" readonly="readonly">
                                <input class="unlikesQuantity <?=$product->isUserDislikeThisProduct()?"quantityDisliked":""?>" name="unlikesQuantity" value="<?=count($product->getDislikes())?>" readonly="readonly">
                                <button class="unlikesButton <?=$product->isUserDislikeThisProduct()?"productDisliked":""?>" data-username="<?=$_SESSION['username']?? "" ?>" product-id="<?=$product->getId()?>" name="unlikesButton" ><img src="../assets/images/dislike.jpg" width="20px" height="20px"></button>
                            </div>
                            <input id="kol" type="number" value="1" min="1" max="10" name="kolicina">
                            <button class="ElrowButton" product-id="<?=$product->getId()?>" name="add">Dodaj u korpu</button>
                            <button class="ElrowButton" name="dettails"><a href="http://localhost/HtmlCSS/webstore/kernel/index.php?page=product_details&id=<?=$product->getId()?>">Detaljnije</a></button>
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

    $("[name=likesButton]").click(function () {
        const productId=$(this).attr("product-id");
        const user=$(this).attr("data-username");
        var likeButton =$(this);
        var unlikeButton = $(this).parent().find('button').eq(1);
        var likeQuantity= $(this).parent().find('input').eq(0);
        var unlikeQuantity= $(this).parent().find('input').eq(1);
        var msg = $(this).parent().parent().find('p');
        if(user===""){
            msg.text("You must be logged in");
        }
        $.post( "http://localhost/HtmlCSS/webstore/kernel/index.php?page=products_like",{productId:productId},function (data){
            parseData=JSON.parse(data);
            console.log(parseData);
            if(!parseData.existLike) {
                likeQuantity.val(parseInt(likeQuantity.val()) + 1);
                unlikeButton.removeClass('productDisliked');
                likeButton.addClass('productLiked');
                unlikeQuantity.removeClass('quantityDisliked');
                likeQuantity.addClass('quantityLiked');
                if (parseData.existUnlike) {
                    unlikeQuantity.val(parseInt(unlikeQuantity.val()) - 1);
                }
            }
        });
        return false;
    });

    $("[name=unlikesButton]").click(function () {
        const productId=$(this).attr("product-id");
        const user=$(this).attr("data-username");
        var likeButton =$(this).parent().find('button').eq(0);
        var unlikeButton =$(this);
        var likeQuantity= $(this).parent().find('input').eq(0);
        var unlikeQuantity= $(this).parent().find('input').eq(1);
        var msg = $(this).parent().parent().find('p');
        if(user===""){
            msg.text("You must be logged in");
        }
        $.post( "http://localhost/HtmlCSS/webstore/kernel/index.php?page=products_unlike",{productId:productId},function (data){
            parseData=JSON.parse(data);
            if(!parseData.existUnlike){
                unlikeQuantity.val(parseInt(unlikeQuantity.val()) + 1);
                likeQuantity.removeClass('quantityLiked');
                likeButton.removeClass('productLiked');
                unlikeQuantity.addClass('quantityDisliked');
                unlikeButton.addClass('productDisliked');
                if(parseData.existLike){
                    likeQuantity.val(parseInt(likeQuantity.val()) - 1);
                }
            }
        });
        return false;
    });

    $("[name=add]").click(function () {
        const id=$(this).attr("product-id");
        var kolicina=$(this).parent().find('input').eq(2).val();
        $.get( "http://localhost/HtmlCSS/webstore/kernel/index.php?page=add_to_cart",{id:id,kolicina:kolicina},function (data){

    });
        return false;
    });
</script>

</body>
</html>