<?php

include 'dbconfig.in.php';
session_start();

if(isset($_POST['addToOrder'])){
        $email = $_POST['email'];
        $productId = $_POST['productId'];
        $productName = $_POST['productName'];
        $price = $_POST['price'];
        $image = $_POST['image'];
        $quantity = $_POST['quantity'];

        $checkCartNumber = $con->prepare("SELECT * FROM `cart` WHERE productName = ? AND email = ?");
        $checkCartNumber->execute([$productName, $email]);

        if($checkCartNumber->rowCount() > 0){
            echo 'It is already added to the cart!';
        } else {
            $insertCart = $con->prepare("INSERT INTO `cart` (email, productId, productName, price, quantity, image) VALUES (?, ?, ?, ?, ?, ?)");
            $insertCart->execute([$email, $productId, $productName, $price, $quantity, $image]);
            echo 'Successfully added to the cart!';
        }
    } else {
        echo 'User email not found in session. Please log in.';
    }

?>



<!DOCTYPE html>
<html lang="en">
        <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>home page</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
        <link rel="stylesheet" href="styleHome.css">

        </head>
        <body>

        <?php include 'header.php'; ?>
        <?php include 'nav.php'; ?>

        <div class="home-bg">
        <section class="home">
            <div class="content">
            <span>Pride of Palestinian production</span>
                <h3>You can support your country by supporting the national product</h3>
                <p>Our store provides every product made in Palestine that guarantees what enhances heritage, such as sculptures and everything that the land produces, such as olives and thyme, in addition to national industries such as olive oil soap.</p>
                <a href="aboutUs.php" class="btn">about us</a>
            </div>
        </section>
        </div>
        <section class="home-category">
        <div class="box-container">
        </div>
        </section>
        <section class="products">
        <div class="box-container">
        <?php
            $chooseProducts = $con->prepare("SELECT * FROM `products` LIMIT 6");
            $chooseProducts->execute();
            if($chooseProducts->rowCount() > 0){
                while($fetchProducts = $chooseProducts->fetch(PDO::FETCH_ASSOC)){ 
        ?>
        <form action="" class="box" method="POST">
            <div class="price">$<span><?= $fetchProducts['price']; ?></span>/-</div>
            <a href="displyProduct.php?productId=<?= $fetchProducts['productId']; ?>" class="fas fa-eye"></a>
            <img src="itemsImages/<?= $fetchProducts['image']; ?>" alt="">
            <div class="productName"><?= $fetchProducts['productName']; ?></div>
            <input type="hidden" name="productId" value="<?= $fetchProducts['productId']; ?>">
            <input type="hidden" name="productName" value="<?= $fetchProducts['productName']; ?>">
            <input type="hidden" name="price" value="<?= $fetchProducts['price']; ?>">
            <input type="hidden" name="image" value="<?= $fetchProducts['image']; ?>">
            <input type="number" min="1" value="1" name="quantity" class="qty">
            <input type="submit" value="add to Order" class="btn" name="addToOrder">
        </form>
        <?php
            }
        }else{
            echo '<p class="empty">no products added yet!</p>';
        }
        ?>
        </div>
        </section>
<?php include 'footer.php'; ?>

</body>
</html>