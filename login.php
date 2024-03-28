<?php

include 'dbconfig.in.php';
 include 'header.php'; 

session_start();

if (isset($_POST['login'])) {

    $userName = $_POST['userName'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM `users` WHERE userName = :userName";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':userName', $userName);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row && $password === $row['password']) {
        header('location:Home.php');
        exit;
    } else {
        echo 'Incorrect user name or password :(';
    }

} else {
    echo 'Please enter your user name and password';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleHome.css">

    <title>Login</title>
</head>
<body>
<section class="form-container">
<form method="post" action="" enctype="multipart/form-data">

<fieldset>
    <legend>Login Form: </legend><br />
    <div style="display: flex; gap: 15px;">
        <lable>User Name : </lable>
        <input type="text" name="userName" class="box" placeholder="Enter your user name" required>
    </div><br />
<div style="display: flex; gap: 15px;">
        <lable>Password : </lable>
        <input type="password" name="password"class="box" placeholder="Enter your password" required>
    </div><br />
</fieldset>
<div style="display: flex; gap: 15px;">
        <input type="submit" name="login" value="login">
    </div>
    <p>Don't have an account? <a href="register.php">New Register</a></p>

</section>
<?php include 'footer.php'; ?>

</body>
</html>
