<html>
<?php
require ("header.php");
?>
<body>
<main id="regmain">
    <div id="registration">
        <h2>REGISTRATION</h2>
        <form id="regform" action="" method="post">

            <input type="text" value="<?php echo isset($_POST["firstname"]) ? $_POST["firstname"] : ''; ?>"name="firstname" placeholder="Enter your name"><br>
            <p><?= implode($templateArray['FNMessage'])?></p>
            <input type="text" value="<?php echo isset($_POST["lastname"]) ? $_POST["lastname"] : ''; ?>" name="lastname" placeholder="Enter your last name"><br>
            <p><?= implode($templateArray['LNMessage'])?></p>
            <input type="text" value="<?php echo isset($_POST["username"]) ? $_POST["username"] : ''; ?>" name="username" placeholder="Enter your username"><br>
            <p><?= implode($templateArray['UNMessage'])?></p>
            <input type="text" value="<?php echo isset($_POST["email"]) ? $_POST["email"] : ''; ?>" name="email" placeholder="Enter your email"><br>
            <p><?= implode($templateArray['EmailMessage'])?></p>
            <input type="password" name="password" placeholder="Enter your password"><br>
            <p><?= implode($templateArray['PassMessage'])?></p>
            <button type="submit" name="submit">Register</button>

        </form>
        <p><?php $a=$templateArray['message'];
                $b=implode($a);
                echo $b;
            ?></p>
    </div>

</main>


</body>
<?php
    require ("footer.php");
?>
</html>