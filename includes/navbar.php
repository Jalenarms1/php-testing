<?php
    session_start();
    
?>

<nav class="navbar bg-cst">
    <ul class="navbar-list ">
    <li class="navbar-item"><a href="/index.php">Home</a></li>
    <li class="navbar-item"><a href="/shop/index.php">Buy</a></li>
    <li class="navbar-item"><a href="/contact/index.php">Contact</a></li>
    <li class="navbar-item"><a href="/map/index.php">Map</a></li>
    <?php if(isset($_SESSION['user_id'])) {
        echo '<li class="navbar-item"><a href="/login/logout.php">Logout</a></li>';
    } else {
        echo '<li class="navbar-item"><a href="/login/index.php">Login</a></li>';
    };
    
    ?>
    </ul>
</nav>
