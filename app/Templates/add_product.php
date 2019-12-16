<html>
<head>
    <title>Admin</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../assets/styleAdmin.css">
</head>
<body>
<header>
    <div id="logo"></div>
    <h1>Add product</h1>
</header>
<main>
    <form method="post" action="" enctype="multipart/form-data">
        <h2>Insert Product</h2>
        Product image<input type="file" name="image"><br>
        <p><?=implode($templateArray['fileMessage'])?></p>
        Product name<input type="text" value="<?php echo isset($_POST["product_name"]) ? $_POST["product_name"] : ''; ?>" name="product_name"><br>
        <p><?=implode($templateArray['nMessage'])?></p>
        Product price<input type="text" value="<?php echo isset($_POST["product_price"]) ? $_POST["product_price"] : ''; ?>" name="product_price"><br>
        <p><?=implode($templateArray['pMessage'])?></p>
        Category id
        <select name="category_id">
            <?php
            /**
             * @var $category \App\Entity\ProductCategory
             */
            ?>
            <?php foreach ($templateArray['categories'] as $category){ ?>
                <option value="<?=$category->getId()?>"><?=$category->getName()?></option>
            <?php } ?>
        </select>
        <p><?=implode($templateArray['cMessage'])?></p>
        <br><br>
        <input type="submit" name="upload" value="Insert Product">
        <p><?=implode($templateArray['mesage'])?></p>
    </form>
</main>

</body>


</html>