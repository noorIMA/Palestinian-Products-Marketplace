<?php
session_start();

include 'dbconfig.in.php';
 include 'header.php'; 

if (isset($_SESSION['basket']) && !empty($_SESSION['basket'])) {
    try {
        $productId = implode(',', $_SESSION['basket']);
        $sql = "SELECT p.productName, p.price FROM products p INNER JOIN orders o ON p.productId = o.productId WHERE o.productId IN ($productId)";
        
      
        $stmt = $con->query($sql);

        if ($stmt->rowCount() > 0) {
            echo '<table>';
            echo '<tr><th>Name</th><th>Price</th></tr>';
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<tr>';
                echo '<td>' . $row['productName'] . '</td>';
                echo '<td>' . $row['price'] . '</td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo " products not found in  order!!!";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "The shopping cart  empty.";
}
?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Palestinane Products</title>
    <link rel="stylesheet" href="styleHome.css"> 
</head>
