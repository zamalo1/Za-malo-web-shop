<head>
    <title>MAZALOO</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../../../HtmlCSS/webstore/assets/style.css">

</head>
<header>
    <div id="logo"><a href="http://localhost/HtmlCSS/webstore/kernel/index.php?page=index"><img src="../assets/images/Untitled.png"></a> </div>
    <h1>ZA-MALO SHOP</h1>
    <button id="login"><a href="http://localhost/HtmlCSS/webstore/kernel/index.php?page=login">Login</a></button>
    <button id="logout" ><a href="http://localhost/HtmlCSS/webstore/kernel/index.php?page=logout">Log out</a></button>
    <button id="cart"></button>
    <div id="nav">
        <div id="proizvodi"><h2>PROIZVODI</h2>
            <ul>
                <?php
                /*** @var $category \App\Entity\ProductCategory */
                ?>
                <?php foreach ($templateArray['categories'] as $category){ ?>
                    <li><a href="http://localhost/HtmlCSS/webstore/kernel/index.php?page=prod_by_category&id=<?=$category->getId()?>"><?=$category->getName()?></a></li>
               <?php } ?>

            </ul>
        </div>
        <button id="button1">LOKACIJE</button>
        <button id="button2">O NAMA</button>
        <button id="button3">KONTAKT</button>
    </div>
</header>