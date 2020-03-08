<html>
<?php
include ("header.php");
?>
<body>
<?php foreach ($templateArray['products'] as $product){?>
<main id="mainDet">
<div id="naslovDet"><?=$product->getName()?></div>
    <div id="slikaDet"><img src="../assets/images/<?=$product->getImages()?>" width="350px" height="350px"> </div>
    <p id="cenaDetText"><b>Product price:</b></p><div id="cenaDet"><b><?=$product->getPrice()?> rsd</b></div>
    <form action="" method="post">
    <div id="qtt">
        <p>Quantity: </p>
    <input id="kolDet" type="text" value="5" name="kolicina" >
        <button name="submitt">Add to cart</button>
    </div>
    <div id="likeDiv">
        <p><?php print_r($templateArray['message'])?></p>
        <button id="likeProduct1" name="like" ><img src="../assets/images/srce.png" width="30px"></button>
        <input id="likeDivQ" type="text" value="<?php $a=new \App\Repository\LikesRepository();
        echo $a->countLikes($product->getId());?>" name="likeQ"  readonly="readonly">
    </div>

        <div id="commentDiv">
                <h2>Comments</h2>
                <input type="hidden" name="product_id" value="<?=$product->getId()?>">
                <input type="hidden" name="date" value="<?=date('D-m-y H:i:s')?>">
                <input type="text" id="textarea" name="textarea" placeholder="  Write your comment...">
                <p></p>
                <button type="submit" id="commentButton" data-product_id="<?=$product->getId()?>" data-date="<?=date('D-m-y H:i:s')?>" data-username="<?=$_SESSION['username']?? "" ?>" name="commentButton">Comment</button>
            <?php } ?>
    </form>
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
                            <button class="likeButton <?=$comment->isUserLikedThisComment()?"likedButton":"" ?>"  name="likeButton" data-comment_id="<?=$comment->getId() ?>" data-username="<?=$_SESSION['username']?? "" ?>" ><img src="../assets/images/like.jpg" width="20px" height="20px"></button>
                            <input class="likeQuantity" value="<?=count($comment->getLikes())?>" name="likeQuantity"  readonly="readonly">
                            <input class="unlikeQuantity" value="<?=count($comment->getDislikes())?>" readonly="readonly">
                            <button class="UnlikeButton" name="unlikeButton" data-comment_id="<?=$comment->getId() ?>" data-username="<?=$_SESSION['username']?? "" ?>" ><img src="../assets/images/dislike.jpg" width="20px" height="20px"></button>
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

  /*  $( "[name=commentButton]" ).click(function() {

        const product_id= $(this).attr('data-product_id');
        const user= $(this).attr('data-username');
        const date= $(this).attr('data-date');
        var textarea=$( "[name=textarea]" ).val();
        $.post( "http://localhost/HtmlCSS/webstore/kernel/index.php?page=post_comment",{product_id:product_id,username:user,date:date,textarea:textarea}, function(data) {
            textarea=$( "[name=textarea]" ).val('');
             parseData=JSON.parse(data);
            //console.log(parseData.comment_by_id);
            $('#commentDiv').find('p').text(parseData.message);

        });
        return false;
    });*/

   $( "[name=likeButton]" ).click(function() {
        const commentId=$(this).attr("data-comment_id");

        var likeButton =$(this);
        var unlikeButton = $(this).parent().find('button').eq(1);
        var likeQuantity= $(this).parent().find('input').eq(0);
       var unlikeQuantity= $(this).parent().find('input').eq(1);
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
       $.post( "http://localhost/HtmlCSS/webstore/kernel/index.php?page=product_unlike",{commentId:commentId,username:user}, function(data) {
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

    </script>
</body>
</html>
