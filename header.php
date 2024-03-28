<?php

if (isset($message)) {
    foreach ($message as $msg) {
        echo '
        <div class="message">
            <span>' . $msg . '</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
        </div>
        ';
    }
}
?>
<header class="header">

    <div class="flex">
        <a href="addProduct.php" class="logo">Gross National Product Store<span>.</span></a>
    <img class="" src="https://cdn-icons-png.flaticon.com/128/5200/5200750.png" alt="Gross National Product Logo">

        <nav class="navigation">
            <a href="home.php">Home</a>
            <a href="displayProduct.php">Shop</a>
            <a href="aboutUs.php">About Us</a>
            <a href="logout.php">Logout</a>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        </nav>

        <div class="icons">
            <a href="searchProduct.php" class="fas fa-search"></a>
            <a href="shoppingCart.php"><i class="fas fa-shopping-cart"></i><span></span></a>
        </div>

    </div>

</header>
