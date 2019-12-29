<html>

<head>
    <title>Admin</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../assets/styleAdmin.css">
</head>
<body>
<header>
    <div id="logo"></div>
    <h1>Update product</h1>
</header>
<main>
    <form method="POST" action="" enctype="multipart/form-data">
        <?php foreach($templateArray['products'] as $product){?>
            Product name: <input type="text" name="product_name" value="<?=$product->getName()?>"><br>
            <p><?=implode($templateArray['name'])?></p>
            Product price: <input type="text" name="product_price" value="<?=$product->getPrice()?>"><br>
            <p><?=implode($templateArray['price'])?></p>
            <img src="../assets/images/<?=$product->getImages()?>"><br>
            <input type="file" name="image">
        <?php } ?>
        <br>
        <br>
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
            <p><?=implode($templateArray['message'])?></p>
        </select>
        <br><br>
        <input type="submit" name="upload" value="Update Product">
        <p><?=implode($templateArray['message'])?></p>
    </form>
</main>

</body>


</html>
