<html>
<?php
include ("header.php");
?>
<body>
<?php foreach ($templateArray['productLikes'] as $product){?>
<main id="mainDet">
<div id="naslovDet"><?=$product->getName()?></div>
    <div id="slikaDet"><img src="../assets/images/<?=$product->getImages()?>" width="350px" height="350px"> </div>
    <p id="cenaDetText"><b>Product price:</b></p><div id="cenaDet"><b><?=$product->getPrice()?> rsd</b></div>
    <div id="qtt">
        <p>Quantity: </p>
    <input id="kolDet" type="text" value="5" name="kolicina" >
        <button name="submitt" id="<?=$product->getId()?>">Add to cart</button>
    </div>
        <div id="likesDivDet">
            <p></p>
            <button class="likesButtonDet <?=$product->isUserLikeThisProduct()?"likedButtonDet":""?>"  product-id="<?=$product->getId()?>" data-username="<?=$_SESSION['username']?? "" ?>" name="likesButtonDet"><img src="../assets/images/like.jpg" width="20px" height="20px"></button>
            <input class="likesQuantityDet <?=$product->isUserLikeThisProduct()?"likedQuantityDet":""?>" name="likesQuantityDet" value="<?=count($product->getLikes())?>" readonly="readonly">
            <input class="unlikesQuantityDet <?=$product->isUserDislikeThisProduct()?"unlikedQuantityDet":""?>" name="unlikesQuantityDet" value="<?=count($product->getDislikes())?>" readonly="readonly">
            <button class="unlikesButtonDet <?=$product->isUserDislikeThisProduct()?"unlikedButtonDet":""?>" product-id="<?=$product->getId()?>" data-username="<?=$_SESSION['username']?? "" ?>" name="unlikesButtonDet"><img src="../assets/images/dislike.jpg" width="20px" height="20px"></button>
        </div>
        <div id="commentDiv">
                <h2>Comments</h2>
                <input type="text" id="textarea" name="textarea" placeholder="  Write your comment...">
                <p></p>
                <button type="submit" id="commentButton" data-username="<?=$_SESSION['user_data']['username']?? "" ?>" data-product_id="<?=$product->getId()?>" date="<?=date('D-m-y H:i:s')?>"  name="commentButton">Comment</button>
            <?php } ?>

            <h3 id="rewCom">Reviews on this product</h3>
            <?php
            /**
             * @var $comment \App\Entity\Comment
             */
            ?>
            <?php foreach ($templateArray['comments'] as $comment){?>
                <table id="table">
                    <tr>
                        <th id="userComm"><?=$comment->getUsername()?></th>
                        <th id="dateComm"><?=$comment->getDate()?></th>
                    </tr>
                    <tr>
                        <td id="text"><?=$comment->getText()?></td>

                        <td id="likeComment">
                            <p id="msg"></p>
                            <button class="likeButton <?=$comment->isUserLikedThisComment()?"likedButton":"" ?>"  name="likeButton" data-comment_id="<?=$comment->getId() ?>" data-username="<?=$_SESSION['username']?? "" ?>" ><img src="../assets/images/like.jpg" width="20px" height="20px"></button>
                            <input class="likeQuantity <?=$comment->isUserLikedThisComment()?"likedQuantity":"" ?>"  value="<?=count($comment->getLikes())?>" name="likeQuantity"  readonly="readonly">
                            <input class="unlikeQuantity <?=$comment->isUserUnlikedThisComment()?"unlikedQuantity":"" ?>" value="<?=count($comment->getDislikes())?>" readonly="readonly">
                            <button class="UnlikeButton <?=$comment->isUserUnlikedThisComment()?"UnlikedButton":"" ?>" name="unlikeButton" data-comment_id="<?=$comment->getId() ?>" data-username="<?=$_SESSION['username']?? "" ?>" ><img src="../assets/images/dislike.jpg" width="20px" height="20px"></button>
                    </td>
                </tr>

            </table>
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
   $("[name=likeButton]" ).click(function() {
        const commentId=$(this).attr("data-comment_id");
        const user=$(this).attr("data-username");
        var likeButton =$(this);
        var unlikeButton = $(this).parent().find('button').eq(1);
        var likeQuantity= $(this).parent().find('input').eq(0);
       var unlikeQuantity= $(this).parent().find('input').eq(1);
       var msg=$(this).parent().find('p');
       if (user===""){
           msg.text("You must be logged in");
       }
       $.post( "http://localhost/HtmlCSS/webstore/kernel/index.php?page=product_like",{commentId:commentId}, function(data) {
           parseData=JSON.parse(data);
           if(!parseData.existLike) {
               likeQuantity.val(parseInt(likeQuantity.val()) + 1);
               unlikeButton.removeClass('UnlikedButton');
               likeButton.addClass('likedButton');
               unlikeQuantity.removeClass('unlikedQuantity');
               likeQuantity.addClass('likedQuantity');
               if (parseData.existUnlike) {
                   unlikeQuantity.val(parseInt(unlikeQuantity.val()) - 1);
               }
           }
    });
        return false;
       });

   $( "[name=unlikeButton]" ).click(function() {
       const commentId=$(this).attr("data-comment_id");
       const user=$(this).attr("data-username");
       var likeButton =$(this).parent().find('button').eq(0);
       var unlikeButton =$(this);
       var likeQuantity= $(this).parent().find('input').eq(0);
       var unlikeQuantity= $(this).parent().find('input').eq(1);
       var msg = $(this).parent().find('p');
       if (user===""){
           msg.text("You must be logged in");
       }
       $.post( "http://localhost/HtmlCSS/webstore/kernel/index.php?page=product_unlike",{commentId:commentId}, function(data) {
           parseData=JSON.parse(data);
           if(!parseData.existUnlike){
               unlikeQuantity.val(parseInt(unlikeQuantity.val()) + 1);
               likeQuantity.removeClass('likedQuantity');
               likeButton.removeClass('likedButton');
               unlikeQuantity.addClass('unlikedQuantity');
               unlikeButton.addClass('UnlikedButton');
               if(parseData.existLike){
                   likeQuantity.val(parseInt(likeQuantity.val()) - 1);
               }
           }
       });
       return false;
   });
   $("[name=likesButtonDet]").click(function () {
       const productId=$(this).attr("product-id");
       const user = $(this).attr("data-username");
       var likeButton =$(this);
       var unlikeButton = $(this).parent().find('button').eq(1);
       var likeQuantity= $(this).parent().find('input').eq(0);
       var unlikeQuantity= $(this).parent().find('input').eq(1);
       var msg = likeButton.parent().find('p');
       if (user===""){
           msg.text("You must be logged in");
       }
       $.post( "http://localhost/HtmlCSS/webstore/kernel/index.php?page=products_like",{productId:productId},function (data){
           parseData=JSON.parse(data);
           if(!parseData.existLike) {
               likeQuantity.val(parseInt(likeQuantity.val()) + 1);
               unlikeButton.removeClass('unlikedButtonDet');
               likeButton.addClass('likedButtonDet');
               unlikeQuantity.removeClass('unlikedQuantityDet');
               likeQuantity.addClass('likedQuantityDet');
               if (parseData.existUnlike) {
                   unlikeQuantity.val(parseInt(unlikeQuantity.val()) - 1);
               }
           }
       });
       return false;
   });
   $("[name=unlikesButtonDet]").click(function () {
       const productId=$(this).attr("product-id");
       const user = $(this).attr("data-username");
       var unlikeButton =$(this);
       var likeButton =$(this).parent().find('button').eq(0);
       var likeQuantity= $(this).parent().find('input').eq(0);
       var unlikeQuantity= $(this).parent().find('input').eq(1);
       var msg = likeButton.parent().find('p');
       if (user===""){
           msg.text("You must be logged in");
       }
       $.post( "http://localhost/HtmlCSS/webstore/kernel/index.php?page=products_unlike",{productId:productId},function (data){
           parseData=JSON.parse(data);
           if(!parseData.existUnlike){
               unlikeQuantity.val(parseInt(unlikeQuantity.val()) + 1);
               likeQuantity.removeClass('likedQuantityDet');
               likeButton.removeClass('likedButtonDet');
               unlikeQuantity.addClass('unlikedQuantityDet');
               unlikeButton.addClass('unlikedButtonDet');
               if(parseData.existLike){
                   likeQuantity.val(parseInt(likeQuantity.val()) - 1);
                   likeButton.removeClass('likedButtonDet');
               }
           }
       });
       return false;
   });
   $("[name=commentButton]").click(function () {
       const product_id=$(this).attr("data-product_id");
       const user=$(this).attr("data-username");
       const date=$(this).attr("date");
       var text=$("[name=textarea]");
       const textarea=$("[name=textarea]").val();
       var msg = $(this).parent().find('p').eq(0);
       if (user===""){
           msg.text('You must be logged in');
       }
       $.post( "http://localhost/HtmlCSS/webstore/kernel/index.php?page=product_comments",{product_id:product_id,date:date,textarea:textarea},function (data){
            text.val("");
       });
       return false;
   });
   $("[name=submitt]").click(function () {
       const id=$(this).attr("id");
       const kolicina=$(this).parent().find('input').val();
       $.get( "http://localhost/HtmlCSS/webstore/kernel/index.php?page=add_to_cart",{id:id,kolicina:kolicina},function (data){

       });
       return false;
   });

    </script>
</body>
</html>
