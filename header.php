<?php
if (empty($_SESSION['id'])) {
    $user_id = "";
} else {
    $user_id = $_SESSION;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/index.css">

    <!-- BootstrapのCSS読み込み -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery読み込み -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- BootstrapのJS読み込み -->
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <header>
        <div class="img">
            <a href="index.php"> <img src="img/logo.png" width="252" height="54" alt=""> </a>
        </div>
        <ul>
            <li> <a href="about.php">ABOUT</a> </li>
            <li> <a href="index.html#menu">MENU</a> </li>
            <li>
                <?php if ($user_id) {  ?>
                    <a href="mypage.php">MYPAGE</a>
                    <a href="logout.php">LOGOUT</a>
                <?php } else { ?>
                    <a href="login.php">LOGIN</a>
                    <a href="register.html">SIGNIN</a>
                <?php } ?>
            </li>
        </ul>