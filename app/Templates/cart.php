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
                <td  align="center"><?=$product->getPrice()?></td>
                <td><input id="kolicina" type="number" value="1"  min="1"  name="quantity"></td>
                <td  align="center"></td>
                <td  align="center" title="ukloni iz korpe"><a href="http://localhost/HtmlCSS/webstore/kernel/index.php?page=remove_from_cart&id=<?=$product->getId();?>"><img src="../assets/images/smece.png"></a></td>
            </tr>
        <?php }
    } ?>

</table><br>
<button id="emptyCart"><a href="http://localhost/HtmlCSS/webstore/kernel/index.php?page=empty_cart">Isprazni korpu</a></button>
    <p id="ukupnoTekst">Ukupan iznos korpe</p><br>
    <div id="ukupno"></div>
    <input id="finish" type="submit" value="Zavrsi kupovinu" name="finishShopping">
    <div class="shopping"><a href="http://localhost/HtmlCSS/webstore/kernel/index.php?page=index">Nastavi sa kupovinom</a> </div>
</form>
<?php include ('footer.php')?>

</html>