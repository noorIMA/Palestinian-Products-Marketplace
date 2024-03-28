<?php

include 'dbconfig.in.php';


$sql = "SELECT * FROM `order` ORDER BY dateOrder DESC";

$stmt = $con->query($sql);
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Orders</title>
    <link rel="stylesheet" href="styleHome.css">
</head>
<body>
<?php include 'header.php'; ?>

    <h2>Customer Orders</h2>
    <table>
        <thead>
            <tr>
                <th>ID Order</th>
                <th>Date Order</th>
                <th>Total Amount</th>
                <th>Status of Order</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><a href="wiewOrder.php?id=<?php echo $order['idOrder']; ?>" target="_blank"><?php echo $order['idOrder']; ?></a></td>
                    <td><?php echo $order['orderdate']; ?></td>
                    <td><?php echo $order['totalamount']; ?></td>
                    <td><?php echo $order['status']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php include 'footer.php'; ?>
</body>
</html>
