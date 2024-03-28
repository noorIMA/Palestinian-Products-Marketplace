<?php
include 'dbconfig.in.php';
include 'header.php';

session_start();

if (isset($_POST['insert'])){
    $name=$_POST['name'];
    $city=$_POST['city'];
    $country=$_POST['country'];
    $dateOfBirth=$_POST['dateOfBirth'];
    $idNumber=$_POST['idNumber'];
    $email=$_POST['email'];
    $telephone=$_POST['telephone'];
    $cardNumber=$_POST['cardNumber'];
    $expirationDate=$_POST['expirationDate'];
    $cardName=$_POST['cardName'];
    $bankIssue=$_POST['bankIssue'];

    $choose = $con->prepare("SELECT * FROM `users` WHERE email=?");
    $choose->execute([$email]);
    $userExists = $choose->fetch(PDO::FETCH_ASSOC);
    
    if ($userExists) {
        echo "User email already exists!";
    } else {
            $register = $con->prepare("INSERT INTO `users`(name,city,country,dateOfBirth,idNumber,email,telephone,cardNumber,expirationDate,cardName,bankIssue) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
            $success = $register->execute([$name, $city, $country, $dateOfBirth, $idNumber, $email, $telephone, $cardNumber, $expirationDate, $cardName, $bankIssue]);

            if ($success) {
                echo "User registered successfully!";
                header("Location: password.php");
            } else {
                echo "Registration failed. Error: " . $register->errorInfo()[2];
            }
        }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styleHome.css">

        <title>Register Form</title>
    </head>
    <body>

    <form method="post" action="" enctype="multipart/form-data">

            <fieldset>
                <legend>Register Form: </legend><br />
                <div style="display: flex; gap: 15px;">
                    <lable>Name : </lable>
                    <input type="text" name="name">
                </div><br />
                <div style="display: flex; gap: 15px;">
                    <lable>City : </lable>
                    <input type="text" name="city">
                    <lable>Country : </lable>
                    <input type="text" name="country">
                </div><br />
                <div style="display: flex; gap: 15px;">
                    <lable>Date of Birth : </lable>
                    <input type="text" name="dateOfBirth" pattern="\d{2}-\d{2}-\d{4}" title="Enter a date in the format dd-mm-yyyy" placeholder="dd-mm-yyyy">
                </div><br />
                <div style="display: flex; gap: 15px;">
                    <lable>ID Number : </lable>
                    <input type="text" name="idNumber">
                </div><br />
                <div style="display: flex; gap: 15px;">
                    <lable>Email : </lable>
                    <input type="email" name="email">
                </div><br />
                <div style="display: flex; gap: 15px;">
                    <lable>Telephone : </lable>
                    <input type="tel" name="telephone">
            </fieldset>
            <fieldset>
            <legend>Credit Card Data: </legend><br />
                <div style="display: flex; gap: 15px;">
                    <lable>Number : </lable>
                    <input type="text" name="cardNumber">
                </div><br />
                <div style="display: flex; gap: 15px;">
                    <lable>Expiration Date :</lable>
                    <input type="text" name="expirationDate" pattern="\d{2}-\d{2}-\d{4}" title="Enter a date in the format dd-mm-yyyy" placeholder="dd-mm-yyyy">
                </div><br />
                <div style="display: flex; gap: 15px;">
                    <lable>Name : </lable>
                    <input type="text" name="cardName">
                </div><br />
                <div style="display: flex; gap: 15px;">
                    <lable>Bank Issue : </lable>
                    <input type="text" name="bankIssue">
                </div><br />
            </fieldset>
            <div style="display: flex; gap: 15px;">
                    <input type="submit" name="insert" value="insert">
                </div>
        </form>
        <?php include 'footer.php'; ?>
        <?php include 'footer.php'; ?>

    </body>
</html>