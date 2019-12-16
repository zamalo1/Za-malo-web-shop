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
    <h1>Products list</h1>
</header>
<main>
    <table>
        <tr>
            <th>Product name</th>
            <th>Edit product</th>
            <th>Delete product</th>
        </tr>
        <?php /**
         * @var $product \App\Entity\Product
         */?>
        <?php foreach ($templateArray['products'] as $product){ ?>
            <tr>
                <td><?=$product->getName();?></td>
                <td><a href="http://localhost/HtmlCSS/webstore/kernel/index.php?page=admin_update_product&id=<?=$product->getId()?>">Edit</a></td>
                <td><a href="http://localhost/HtmlCSS/webstore/kernel/index.php?page=admin_delete_product&id=<?=$product->getId()?>">Delete</td>
            </tr>
        <?php } ?>

    </table>



</main>

</body>

</html>