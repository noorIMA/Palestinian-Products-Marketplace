<?php
$host = 'localhost';
$user = 'web1200588_dbuser';
$password = '!5BHEux89P';
$db_name = 'web1200588_db';

try {
    $con = new PDO("mysql:host=$host;dbname=$db_name", $user, $password);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connection Done ";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
