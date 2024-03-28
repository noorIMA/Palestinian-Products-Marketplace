<?php
include 'dbconfig.in.php';

include 'header.php'; 

function addToBasket($productId) {
    session_start();

    if (!isset($_SESSION['basket'])) {
        $_SESSION['basket'] = array();
    }

    if (!in_array($productId, $_SESSION['basket'])) {
        $_SESSION['basket'][] = $productId;
    }
}
if (isset($_POST['addToOrder']) && isset($_POST['productId'])) {
    try {
    
        $productId = $_POST['productId'];
        $sql = "INSERT INTO order (productId) VALUES (:productId)";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':productId', $productId);
        $stmt->execute();
        addToBasket($productId);
        header("Location: shoppingCart.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        error_log("Error in addToBasket: " . $e->getMessage(), 0);
    }
}
?>
