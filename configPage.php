<?php
include("dbconfig.in.php");
include("header.php");

session_start();

if (isset($_POST['view'])) {
    $email = $_POST['email'];
    $query = "SELECT * FROM `users` WHERE email = ?";
    $stmt = $con->prepare($query);
    $stmt->execute([$email]);

    if ($stmt !== false) {
        $result = $stmt->fetchAll();
        if (count($result) > 0) {
            foreach ($result as $row) {
                echo "Name :" . $row['name'].  "<br>"; 
                echo "Address :". $row['city']. ",". $row["country"]."<br>";
                echo "Date of Birth :" . $row['dateOfBirth'].  "<br>"; 
                echo "ID Number :" . $row['idNumber'].  "<br>"; 
                echo "Email :" . $row['email'].  "<br>"; 
                echo "Telephone :" . $row['telephone'].  "<br>"; 
                echo "Card Number :" . $row['cardNumber'].  "<br>"; 
                echo "Expiration Date :" . $row['expirationDate'].  "<br>"; 
                echo "Card Name :" . $row['cardName'].  "<br>"; 
                echo "Bank Issue :" . $row['bankIssue'].  "<br>"; 
                echo "User Name :" . $row['userName'].  "<br>"; 
                echo "Password :" . $row['password'].  "<br>"; 
            }
        
        } else {
            echo "Not found with the entered email.";
        }
    } else {
        echo "Error !!!";
    }
} else {
    echo "Please provide an email :)";
}
if (isset($_POST['confirm'])) {
    $tempTimes = time();
    $random = mt_rand(100000000, 999999999); 
    $dCustomer = $tempTimes . $random; 
    return substr($dCustomer, 0, 10); 
    $choose = $con->prepare("SELECT * FROM `users` ");
    $update = $con->prepare("UPDATE `users` SET idCustomer=? ");
    $success = $update->execute([$idCustomer]);
    header("Location: loginOptions.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleHome.css">

    <title>Confirm Registration</title>
</head>
<body>
    <form method="post" action="" enctype="multipart/form-data">
        <div style="display: flex; gap: 15px;">
            <label for="email">Email:</label>
            <input type="email" name="email" >
            <div style="display: flex; gap: 15px;">
                    <input type="submit" name="view" value="view">
            </div>
            <div style="display: flex; gap: 15px;">
                    <input type="submit" name="confirm" value="confirm">
            </div>
        </div>
    </form>
    <?php include 'footer.php'; ?>
</body>
</html>
