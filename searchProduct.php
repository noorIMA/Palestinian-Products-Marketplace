<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleHome.css"> 
    <title>Search Product</title>
</head>
<body>
  <?php include'header.php';?>
    <form action="" method="GET">
        <label for="productName">Product Name:</label>
        <input type="text" id="productName" name="productName">
        <label for="minPrice">Minimum Price:</label>
        <input type="number" id="minPrice" name="minPrice">
        <label for="maxPrice">Maximum Price:</label>
        <input type="number" id="maxPrice" name="maxPrice">
        <input type="submit" value="Search">
    </form>

    <form action="" method="POST">
    <table>
        <thead>
            <tr>
                <th><button id="shortlist-btn">Shortlist</button></th>
                <th><a href="?sort=productId"> Product ID</a></th>
                <th><a href="?sort=price">Price</a></th>
                <th><a href="?sort=category">Category</a></th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            <?php
    include 'dbconfig.in.php';

    $quere = "SELECT productId, category, price, quantity FROM products WHERE 1";
    if (!empty($_GET['productName'])) {
        $productName = $_GET['productName'];
        $quere .= " AND productName LIKE '%$productName%'";
    }
    if (!empty($_GET['minPrice'])) {
        $minPrice = $_GET['minPrice'];
        $quere .= " AND price >= $minPrice";
    }
    if (!empty($_GET['maxPrice'])) {
        $maxPrice = $_GET['maxPrice'];
        $quere .= " AND price <= $maxPrice";
    }
    $sort = isset($_GET['sort']) ? $_GET['sort'] : 'productId';
    switch ($sort) {
        case 'productId':
            $quere .= " ORDER BY productId";
            break;
        case 'price':
            $quere .= " ORDER BY price";
            break;
        case 'category':
            $quere .= " ORDER BY category";
            break;
        default:
            $quere .= " ORDER BY productId";
            break;
    }
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(isset($_POST['shortlist'])) {
                if(isset($_POST['selectedProducts']) && !empty($_POST['selectedProducts'])) {
                    $selectedProducts = $_POST['selectedProducts'];
                    foreach ($selectedProducts as $productId) {
                        $stmt = $con->prepare("SELECT productId, price, category, quantity FROM products WHERE productId = ?");
                        $stmt->execute([$productId]);
                        $product = $stmt->fetch(PDO::FETCH_ASSOC);
                        if ($product) {
                            echo '<tr>';
                            echo '<td><input type="checkbox" productName="selectedProducts[]" value="' . $product['productId'] . '" checked></td>';
                            echo '<td><a href="displayinfo.php?id=' . $product['productId'] . '">' . $product['productId'] . '</a></td>';
                            echo '<td>' . $product['price'] . '</td>';
                            echo '<td>' . $product['category'] . '</td>';
                            echo '<td>' . $product['quantity'] . '</td>';
                            echo '</tr>';
                        }
                    }
                } else {
                    echo '<tr><td colspan="5">No products selected for shortlisting.</td></tr>';
                }
            }
        } else {
            $result = $con->query($quere);

            if ($result->rowCount() > 0) {
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo '<tr>';
                    echo '<td><input type="checkbox"></td>';
                    echo '<td><a href="displayProduct.php?id=' . $row['productId'] . '">' . $row['productId'] . '</a></td>'; 
                    echo '<td>' . $row['price'] . '</td>';
                    echo '<td>' . $row['category'] . '</td>';
                    echo '<td>' . $row['quantity'] . '</td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="5"> product not found</td></tr>';
            }}
            ?>
        </tbody>
    </table>
</body>
</html>
