<?php
    require '../includes/navbar.php';

    if(!isset($_SESSION['user_id'])) {
        header('Location: /login/index.php');
    }
    
    include '../db.php';

    
    // Check connection
    if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM product";
    $result = mysqli_query($conn, $sql);
    $products = $result->fetch_all(MYSQLI_ASSOC);
?>

<head>
    <!-- Include your client id  -->
    <script src="https://www.paypal.com/sdk/js?client-id=YOUR_CLIENT_ID&currency=USD" defer></script>
    <script type="text/javascript" src="/shop/script.js" defer></script>
    <script type="text/javascript" src="/script.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/styles.css">
    <link rel="stylesheet" href="/shop/styles.css">

</head>



    
<div class="shop-wrap">
    <div class="product-section">
        <?php
            foreach($products as $product) {

        ?>
            <div class="product-card">
                <h3 class="product-name"><?php echo $product['name']; ?></h3>
                <img src="<?php echo $product['image']; ?>" alt="coffee">
                <p class="product-availability"><?php if($product['inventory'] > 0) {
                    echo 'In stock';
                } else {
                    echo 'Unavailable';
                }
                ?></p>
                <p class="product-price">Price: $<?php echo number_format($product['price'], 2); ?></p>
                <button class="add-to-cart-button">Add to Cart</button>
                <input type="hidden" name="id" id="item-id" value="<?php echo $product['id']; ?>">
                <input type="hidden" name="item-name" id="item-name"  value="<?php echo $product['name']; ?>">
                <input type="hidden" name="item-image" id="item-image" value="<?php echo $product['image']; ?>">
                <input type="hidden" name="item-price" id="item-price" value="<?php echo $product['price']; ?>">
                <input type="hidden" name="user_id" id="user-id" value="<?php echo $_SESSION['user_id']; ?>">
            </div>
        <?php
            }
        ?>
        
    </div>
    
    <div class="cart-section">
        <h3 class="cart-title">Your Cart</h3>
        <div class="cart-items">

        </div>
        <p class="cart-total" id="cart-total"></p>
        <div class="submit-order-button hide" id="paypal-button-container"></div>
    </div>

</div>

<?php
    require '../includes/footer.php';
?>

