<?php
    
    require '../includes/navbar.php';

    include '../db.php';

    // Check the connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
   


    if(isset($_POST['newPassword-submit'])) {

        // Handle the form submission
        $username = $_POST["username"];
        $password = mysqli_real_escape_string($conn, $_POST["new-password"]);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
        // Update the password in the database
        $sql = "UPDATE user SET password = '$hashed_password' WHERE username = '$username'";
    
        if (mysqli_query($conn, $sql)) {
            $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
            $row = mysqli_fetch_assoc($result);
            if (array_key_exists('id', $row)) {
                // Extract the user ID from the data
                $user_id = $row['id'];
                // Start the session
                session_start();
                // Store the user ID in the session
                $_SESSION['user_id'] = $user_id;
                // Set a cookie
                setcookie("user_id", $user_id, time() + (86400 * 30), "/");
              } else {
                // 'id' key is not present in the query result
                echo "Error: 'id' key not found in query result.";
            }
            // $user_id = 23;
            // session_start();
            // $_SESSION['user_id'] = $user_id;
            // setcookie("logged_in", true, time() + (60 * 60 * 24 * 30));
            header('Location: /index.php');
        } else {
            $message = "Error updating password: " . mysqli_error($conn);
        }

        // Close the database connection
    }
    mysqli_close($conn);
?>
<head>
    <script type="text/javascript" src="/login/script.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/login/styles.css">
    <link rel="stylesheet" href="/styles.css">
</head>
<div class="container">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="login-form" id="new-pass-form">
        <h2 class="form-title">Reset Password</h2>
        <p>Enter your new password.</p>
        <div class="form-group">
            <label for="login-username" class="form-label">Password:</label>
            <input type="password" id="new-password" name="new-password" class="form-input">
            <input type="hidden" name="username" value="<?php echo $_POST['username'] ?>">
        </div>
        
        <input type="submit" name="newPassword-submit" class="submit-button" id="reset-submit-btn"/>
    </form>
</div>