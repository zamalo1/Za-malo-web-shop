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
                        <div id="mazalo"> <img src="../assets/images/<?=$product->getImages()?>"></div>
                        <p id="p1"><?=$product->getName()?></p>
                        <p id="cena1"><b>Cena: <?=$product->getPrice()?>rsd</b></p><br>
                        <form action="" method="post">
                            <button type="submit" name="add"><a href="http://localhost/HtmlCSS/webstore/kernel/index.php?page=add_to_cart&id=<?=$product->getId()?>">Dodaj u korpu</a></button>
                            <button>Detaljnije</button>
                        </form>

                    </div>
                <?php } ?>
            </div>


    </main>
    <?php
    include ("footer.php");

    ?>

</body>
</html>