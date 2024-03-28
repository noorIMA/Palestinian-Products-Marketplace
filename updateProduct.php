<?php

include 'dbconfig.in.php';
include 'header.php';

if(isset($_POST['updateQuantity'])){
    $productId = $_POST['productId'];
    $quantity = $_POST['quantity'];

    $choose = $con->prepare("SELECT * FROM `products` WHERE productId=?");
    $choose->execute([$productId]);
    $userExists = $choose->fetch(PDO::FETCH_ASSOC);

    if ($userExists) {
            $update = $con->prepare("UPDATE `products` SET quantity=? WHERE productId=?");
            $success = $update->execute([$quantity, $productId]);

            if ($success) {
                echo "quantity update successfully!";
            } else {
                echo "quantity update failed. Error: " . $update->errorInfo()[2];
            }
        }
    } 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleHome.css">

    <title>Update Products Quantity</title>
</head>
<body>
<form method="post" action="" enctype="multipart/form-data">

<fieldset>
    <legend>Update Quantity : </legend><br />
    <div style="display: flex; gap: 15px;">
        <label>Product ID : </label>
        <input type="text" name="productId">
    </div><br />
    <div style="display: flex; gap: 15px;">
        <label> Quantity :</label>
        <input type="number" name="quantity">
    </div><br />
    <div style="display: flex; gap: 15px;">
        <input type="submit" name="updateQuantity" value="update Quantity">
    </div>
</fieldset>
</form>
<?php include 'footer.php'; ?>

</body>
</html>