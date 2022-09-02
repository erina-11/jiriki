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
</header>