
<html>
<head>
    <title>Admin</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../assets/styleAdmin.css">
</head>
<body>
<header>
    <div id="logo"></div>
    <h1>ADMIN PAGE</h1>
</header>
<main>
    <form method="post" action="" enctype="multipart/form-data">
        <h2>Insert Category</h2>
        Category name<input type="text" name="category_name"><br>
        <p><?=implode($templateArray['categoryMessage'])?></p>
        <br>
        <input type="submit" name="upload" value="Insert category">
    </form>
    <p><?=implode($templateArray['newMessage'])?></p>
</main>

</body>


</html>