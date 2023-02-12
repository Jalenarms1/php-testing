<?php
    include '../db.php';

    // Check the connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    if(isset($_POST)) {
        $data = file_get_contents("php://input");
        $orderData = json_decode($data, true);
        $total = $orderData['total'];
        $userId = $orderData['userId'];
        $products = $orderData['products'];
    
        // Insert into orders table
        $sql = "INSERT INTO `order` (total, user) VALUES ($total, $userId)";
        if (mysqli_query($conn, $sql)) {
            // Get the last insert id
            $order_id = mysqli_insert_id($conn);
    
            // Loop through the products
            foreach ($products as $product) {
                $product_id = $product["id"];
                $quantity = $product['quantity'];
    
                // Insert into order_items table
                $sql = "INSERT INTO orderItem (orderId, productId) VALUES ('$order_id', '$product_id')";
                mysqli_query($conn, $sql);

                // update product quantity
                $updateProductSql = "UPDATE `product` SET inventory = inventory - $quantity WHERE id = $product_id";
                $updateProductResult = mysqli_query($conn, $updateProductSql);
            }
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

    }
    // Get the data from the request
    // $total = json_decode($_POST["total"]);
    // $user_id = json_decode($_POST["userId"]);
    // $products = json_decode($_POST["products"]);

    // Close connection
    mysqli_close($conn);
?>