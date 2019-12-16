
<html>
<?php
require ("header.php");
?>
<body>
<main>
    <div id="loginUser">
        <h2>LOG IN</h2>
        <form id="logform" action="" method="post">
            <input type="text" value="<?php echo isset($_POST["username"]) ? $_POST["username"] : ''; ?>"name="username" placeholder="Enter your username"><br>
            <p><?=implode($templateArray['userMessage']);?></p>
            <input type="password" name="password" placeholder="Enter your password"><br>
            <p><p><?=implode($a=$templateArray['passMessage']);?></p></p>
            <button type="submit" name="login">Login</button>
        </form>
        <p><a href="http://localhost/HtmlCSS/webstore/kernel/index.php?page=registration">Register here!!!</a><p><br>
        <p>
            <?=implode($templateArray['mesage']);?>

        </p>
    </div>

</main>


</body>
<?php
require ("footer.php");
?>
</html>