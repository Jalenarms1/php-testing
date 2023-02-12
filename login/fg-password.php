<?php
    require '../includes/navbar.php';

    include '../db.php';



    // Check the connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if(isset($_POST['submit'])) {

        // Handle the form submission
        $username = $_POST['username'];

        // Define the SQL query
        $sql = "SELECT * FROM user WHERE username = '$username'";

        // Execute the query
        $result = mysqli_query($conn, $sql);

        // Check if the query returned any results
        if (mysqli_num_rows($result) > 0) {
            // Fetch the user information
            $user = mysqli_fetch_assoc($result);
            $user_found = true;
        } else {
            $user_found = false;
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
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="login-form">
        <h2 class="form-title">Change Password</h2>
        <p>Enter the username associated with your account</p>
        <div class="form-group">
            <label for="login-username" class="form-label">Username:</label>
            <input type="text" id="login-username" name="username" class="form-input">
        </div>
        
        <input type="submit" name="submit" class="submit-button"/>
    </form>
    <?php if (isset($user_found) && $user_found) : ?>
    <!-- Render the div if the user was found -->
    <form action="reset-password.php" id="answerForm" method="POST" class="sec-questions">
        <h2>Security questions</h2>
        <p>Answer the following questions to reset your password</p>
        <p class="err-text hide" id="err-text">One of the following answers were incorrect. Try again.</p>
        <div class="form-group">
            <label for="login-username" class="form-label"><?php echo $user['securityQ1'] ?></label>
            <input type="text" id="q1Answer" name="securityQ1Answer" class="form-input" required>
            <input type="hidden" name="answer1" id="answerOne" value="<?php echo $user['securityQ1Answer'] ?>">
            <input type="hidden" name="username" value="<?php echo $user['username'] ?>">
        </div>
        <div class="form-group">
            <label for="login-username" class="form-label"><?php echo $user['securityQ2'] ?></label>
            <input type="text" id="q2Answer" name="securityQ2Answer" class="form-input" required>
        </div>
        <input type="submit" name="answer-submit" id="answer-submit" value="Submit answers" class="submit-button"/>

    </form>
    <?php elseif (isset($user_found) && !$user_found) : ?>
    <!-- Render the div if the user was not found -->
    <div>
        User not found.
    </div>
    <?php endif; ?>
</div>

<?php
    require '../includes/footer.php';
?>

