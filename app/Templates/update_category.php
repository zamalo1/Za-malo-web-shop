
<html>

<head>
    <title>Admin</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../assets/styleAdmin.css">
</head>
<body>
<header>
    <div id="logo"></div>
    <h1>Update category</h1>
</header>
<main>
    <form method="post" action="" enctype="multipart/form-data">
        <h2>Old category</h2>

        Category name
        <select name="category_name">
            <?php
            /**
             * @var $category \App\Entity\ProductCategory
             */
            ?>
            <?php foreach ($templateArray['categories'] as $category){ ?>
                <option value="<?=$category->getId()?>"><?=$category->getName()?></option>
            <?php } ?>
        </select>
        <p><?=implode($templateArray['categoryMessage'])?></p>
        <h2>New category</h2><br>

        New category name<input type="text" name="new_name"><br>
        <p><?= implode($templateArray['newMessage'])?></p>
        <br><br>
        <input type="submit" name="upload" value="Update category">
    </form>
    <p><?= implode($templateArray['mesage'])?></p>
</main>

</body>


</html>