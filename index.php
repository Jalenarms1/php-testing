<?php
include './db.php';

  // Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$query = "SELECT * FROM product";
$result = mysqli_query($conn, $query);

// Convert the result into an associative array
$products = mysqli_fetch_all($result, MYSQLI_ASSOC);

$random_products = array_slice($products, 0, 3);

// Close the database connection
mysqli_close($conn);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="./script.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./styles.css">
    <title>Document</title>
    
</head>
    
<body>
    <!-- <nav class="navbar bg-cst">
      <ul class="navbar-list ">
        <li class="navbar-item"><a href="#home">Home</a></li>
        <li class="navbar-item"><a href="#buy">Buy</a></li>
        <li class="navbar-item"><a href="#contact">Contact</a></li>
        <li class="navbar-item"><a href="#about">About</a></li>
        <li class="navbar-item"><a href="#map">Map</a></li>
      </ul>
    </nav> -->
    <?php include './includes/navbar.php'; ?>
    <div class="top">
      <!-- <h1 class="header">The Daily Grind Coffee House</h1> -->
      <img src="/images/dailygrindlogo.jpg" alt="logo" class="home-logo">
      <div class="info-wrap">
        <p class="address"><b>605 Washington St</b></p>
        <p class="address"><b>Fayette, IA 52142</b></p>
        <p class="phone"><b>888-555-5555</b></p>

      </div>
    </div>
    <ul class="features-list">
      <li class="feature-item"><b>Specialty Coffees and Teas</li>
      <li class="feature-item">Homemade Breads and Pastries</li>
      <li class="feature-item feature-item-link">
        <a href="/house-blend/index.php">Take Home the Daily Grind House Blend</a>
        <img src="/images/coffee-cup.png" alt="cup">
      </li>
    </ul>
    <section class="menu">
      <div class="wrap-random-products">
        <h3 class="header">Featured Products</h3>
        <?php
          
          // $random_products = array_rand($products, 3);
          foreach($random_products as $product) {
        ?>
          <div class="product-card-home">
            <img src="<?php echo $product['image']; ?>" alt="coffee">
            <h3 class="product-name"><?php echo $product['name']; ?></h3>
            
            <p class="product-price">Price: $<?php echo number_format($product['price'], 2); ?></p>
            
            
          </div>
        <?php
          }
        ?>
        <a class="see-more-products" href="/dailygrind/shop/index.php">See more</a>
      </div>
      <!-- <div class="menu-item">
        <h3>About us</h3>
        <p>At The Daily Grind, we're more than just a place to grab a cup of coffee. We're a community of coffee lovers, baristas, and friends. Our passion for handcrafted blends made from the finest beans is what drives us to create the perfect cup for you, every time. Come visit us, relax, and experience the rich and comforting flavors of our coffee. We can't wait to share a cup with you!</p>
      </div> -->
      <div class="menu-item-img">
        <img src="/images/Breads.jpg" alt="home_pic" class="home-img" id="home-img">
      </div>
      
    </section>

    <?php include './includes/footer.php'; ?>
</body>

</html>

