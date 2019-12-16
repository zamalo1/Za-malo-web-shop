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
                        <div id="mazalo"> <img src="../../webstore/assets/images/<?php echo $product->getImages();?>"></div>
                        <p id="p1"><?=$product->getName()?></p>
                        <p id="cena1"><b>Cena: <?=$product->getPrice()?>rsd</b></p>
                        <button>Detaljnije</button>
                    </div>
                <?php } ?>
            </div>


    </main>
    <?php
    include ("footer.php");

    ?>

</body>
</html>