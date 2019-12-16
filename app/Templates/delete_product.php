<?php
use App\Entity\Product;
?>
<html>

<head>
    <title>Admin</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../assets/styleAdmin.css">
</head>
<body>
<header>
    <div id="logo"></div>
    <h1>DELETE PRODUCT</h1>
</header>
<main>
    <form method="post" action="">
        <?php foreach ($templateArray['products'] as $product)?>
        Product name:    <?=$product->getName()?><br><br>

        <img src="../assets/images/<?=$product->getImages()?>"><br><br>

        <button type="submit" name="delete">DELETE PRODUCT</button>

    </form>



</main>

</body>

</html>
