<?php
include 'dbconfig.in.php';
include 'header.php';

session_start();

if (isset($_POST['register'])){
    $email = $_POST['email'];
    $userName = $_POST['userName'];
    $password = $_POST['password'];
    $configPassword = $_POST['configPassword'];

    if (strlen($userName) < 6 || strlen($userName) > 13) {
        echo "Username should be between 6 and 13 characters.";
        exit;
    }
    if (strlen($password) < 8 || strlen($password) > 12) {
        echo "Password should be between 8 and 12 characters.";
        exit;
    }

    $choose = $con->prepare("SELECT * FROM `users` WHERE email=?");
    $choose->execute([$email]);
    $userExists = $choose->fetch(PDO::FETCH_ASSOC);
    
    if ($userExists) {
        if ($password != $configPassword) {
            echo "Confirm password not matched!";
        } else {
            $update = $con->prepare("UPDATE `users` SET userName=?, password=? WHERE email=?");
            $success = $update->execute([$userName, $password, $email]);

            if ($success) {
                echo "User registered successfully!";
                header("Location: configPage.php");
            } else {
                echo "Registration failed. Error: " . $update->errorInfo()[2];
            }
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

    <title>Confirm Registration</title>
</head>
<body>
<form method="post" action="" enctype="multipart/form-data">

    <fieldset>
        <legend>Confirm Registration : </legend><br />
        <div style="display: flex; gap: 15px;">
            <label>Email : </label>
            <input type="email" name="email">
        </div><br />
        <div style="display: flex; gap: 15px;">
            <label>User Name : </label>
            <input type="text" name="userName">
        </div><br />
        <div style="display: flex; gap: 15px;">
            <label>Password : </label>
            <input type="password" name="password">
        </div><br />
        <div style="display: flex; gap: 15px;">
            <label>Confirm Password: </label>
            <input type="password" name="configPassword">
        </div><br />
        <div style="display: flex; gap: 15px;">
            <input type="submit" name="register" value="register">
        </div>
    </fieldset>
</form>
<?php include 'footer.php'; ?>

</body>
</html>
