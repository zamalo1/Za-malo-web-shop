<html>
<?php
include ("header.php");
?>
<h2 id="naslovKorpe">SHOPPING CART</h2>
<table style="width:50%" align="center">

    <tr >
        <th>Slika Proizvoda </th><br>
        <th>Naziv proizvoda</th>
        <th>Pojedinacna cena</th>
        <th>Kolicina</th>
        <th>Ukupno</th>
        <th>Ukloni Artikal</th>
    </tr>
    <h2 id="praznaKorpa"><?php if(empty($_SESSION['cart'])){ echo "NEMA PROIZVODA U KORPI!!!";}else{echo '';}?></h2>
    <form action="" method="post">
    <?php if(!empty($_SESSION['cart'])){
        foreach ($templateArray['products'] as $product){?>
            <tr>
                <td  align="center"><img src="../assets/images/<?=$product->getImages()?>" width="50px" height="50px"></td>
                <td  align="center"><?=$product->getName()?></td>
                <td  align="center"><input id="cena" value="<?=$product->getPrice()?>" readonly="readonly"></td>
                <td><input type="text" value="<?=$product->getQuantity() ?>" readonly="readonly" min="1" max="10" id="kolicina" name="kolicina"></td>
                <td  align="center"><input id="ukupno1" value="<?=$product->getPrice() * $product->getQuantity()?>"  readonly="readonly"></td>
                <td  align="center" title="ukloni iz korpe"><a href="http://localhost/HtmlCSS/webstore/kernel/index.php?page=remove_from_cart&id=<?=$product->getId();?>"><img src="../assets/images/smece.png"></a></td>
            </tr>

        <?php }
    } ?>

</table><br>
<button id="emptyCart"><a href="http://localhost/HtmlCSS/webstore/kernel/index.php?page=empty_cart">Isprazni korpu</a></button>
    <p id="ukupnoTekst">Ukupan iznos korpe</p><br>
    <div id="ukupno"><input id="sveukupno" value="<?php
        if(!empty($_SESSION['ukupno'])){
            echo array_sum($_SESSION['ukupno']);
        }echo '';
        ?>" readonly="readonly" ></div>
    <input id="finish" type="submit" value="Zavrsi kupovinu" name="finishShopping">
    <div class="shopping"><a href="http://localhost/HtmlCSS/webstore/kernel/index.php?page=index">Nastavi sa kupovinom</a> </div>
</form>
<?php include ('footer.php')?>

</html>