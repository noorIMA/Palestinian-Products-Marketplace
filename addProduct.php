    <?php
    include 'dbconfig.in.php';
    session_start();


    if(isset($_POST['addProduct'])){

        $productName = $_POST['productName'];
        $productDescription = $_POST['productDescription'];
        $category = $_POST['category'];
        $price = $_POST['price'];
        $size = $_POST['size'];
        $remarks = $_POST['remarks'];
        $quantity = $_POST['quantity'];
        $productId = generateIDProduct();


    $image = $_FILES['image']['name'];
    $imageSize = $_FILES['image']['size'];
    $imageTempName = $_FILES['image']['tmp_name'];
    $imageFolder = 'itemsImages/'.$image;

    $chooseProducts = $con->prepare("SELECT * FROM `products` WHERE productName = ?");
    $chooseProducts->execute([$productName]);

    if($chooseProducts->rowCount() > 0){
        $message[] = 'product name already exist!';
    }else{

        $addProducts = $con->prepare("INSERT INTO `products`(productId,productName, productDescription,category, price,size,remarks,quantity, image) VALUES(?,?,?,?,?,?,?,?,?)");
        $addProducts->execute([$productId,$productName,$productDescription, $category, $price, $size,$remarks,$quantity,$image]);

    }
    };

    function generateIDProduct() {
        $tempTimes = time();
        $random = mt_rand(100000000, 999999999); 
        $productId = $tempTimes . $random; 
        return substr($productId, 0, 10); 
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleHome.css">

    <title>ADD Products</title>
    </head>
    <body>
    <section class="add-products">

    <h1 class="title">add new product</h1>

    <form method="post" action="" enctype="multipart/form-data">

        <fieldset>
            <legend>ADD Product Form: </legend><br />
            <div style="display: flex; gap: 15px;">
                <lable> ProductName : </lable>
                <input type="text" name="productName">
            </div><br />
            <div style="display: flex; gap: 15px;">
                <lable>Product Description : </lable>
                <textarea name="productDescription" rows="4" cols="50"></textarea>
            </div><br />
            <div style="display: flex; gap: 15px;">
            <lable>category : </lable>
            <select name="category">
                    <option value="New arrival">New Arrival</option>
                    <option value="On Sale">On Sale</option>
                    <option value="Featured">Featured</option>
                    <option value="High Demand">High Demand</option>
                    <option value="Normal" selected>Normal</option>
            </div><br />
            <div style="display: flex; gap: 15px;">
                <lable> </lable>
                <input type="" name="">
            </div><br />
            <div style="display: flex; gap: 15px;">
                <lable>Price : </lable>
                <input type="number" name="price">
            </div><br />
            <div style="display: flex; gap: 15px;">
                <lable>Size : </lable>
                <input type="text" name="size">
            </div><br />
            <div style="display: flex; gap: 15px;">
                <lable>Remarks : </lable>
                <textarea name="remarks" rows="4" cols="50"></textarea>
            </div><br />
            <div style="display: flex; gap: 15px;">
                <lable> Quantity : </lable>
                <input type="number" name="quantity">
            </div><br />
            <div style="display: flex; gap: 15px;">
                            <lable>Product Photo: </lable>
                            <input type="file" name="image" accept="image/jpeg">
                        </div><br />
        </fieldset>
        <div style="display: flex; gap: 15px;">
                <input type="submit" name="addProduct" value="addProduct">
            </div>
        </form>
    </body>
</html>