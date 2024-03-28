<!DOCTYPE html>
    <html lang="en">
        <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>E-Store product</title>
        <link rel="stylesheet" href="styleHome.css"> 
        </head>
            <body>
        <?php
        include 'dbconfig.in.php';
        include 'header.php';

        $query = "SELECT productId, productName, productDescription, price, image FROM products";
        $results = $con->query($query);

        if ($results->rowCount() > 0) {
            echo '<table>';
            echo '<tr><th>Product Name</th><th>Price</th><th>Product Description</th><th>Image</th><th>Action</th></tr>';
        
            while ($row = $results->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr>';
            echo '<td>' . $row['productName'] . '</td>';
            echo '<td>' . $row['price'] . '</td>'; 
            echo '<td>' . $row['productDescription'] . '</td>'; 

            // Assuming the image column contains the file name with extension, e.g., "example.jpg"
            $image = 'itemsImages/' . $row['image'];
            
            // Check if the image file exists
            if (file_exists($image)) {
                echo '<td><img class="productImg" src="' . $image . '" alt="' . $row['productName'] . '"></td>';
            } else {
                echo '<td>Image not found</td>';
            }

            echo '<td><a href="shoppingCart.php?productId=' . $row['productId'] . '"><img src="https://cdn-icons-png.flaticon.com/128/3523/3523885.png" width="40" height="40" alt="Add to Order"></a></td>';
            echo '</tr>';
            }
            echo '</table>';
        } else {
            echo "No products found";
        }
        ?>
            </body>
            <?php include 'footer.php'; ?>

    </html>