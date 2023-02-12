<?php
    require '../includes/navbar.php';
    // session_start();
    if(isset($_SESSION['user_id'])) {
        header('Location: /index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
    <script type="text/javascript" src="/login/script.js" defer></script>
    <link rel="stylesheet" href="/login/styles.css">
    <link rel="stylesheet" href="/styles.css">
    <title>Document</title>
</head>
<body>
    
        <div class="container">
            <form action="./submit.php" method="POST" class="login-form">
                <h2 class="form-title">Login</h2>
                <div class="form-group">
                <label for="login-username" class="form-label">Username:</label>
                <input type="text" id="login-username" name="username" class="form-input">
                </div>
                <div class="form-group">
                <label for="login-password" class="form-label">Password:</label>
                <input type="password" name="password" id="login-password" class="form-input">
                </div>
                <button type="submit" class="submit-button">Login</button>
                <a href="fg-password.php" class="fg-pass-link">Forgot password?</a>
            </form>
            <form action="./submit.php" method="POST" class="signup-form">
                <h2 class="form-title">Need to Sign Up?</h2>
                <div class="form-group">
                    <label for="signup-username" class="form-label">Username:</label>
                    <input type="text" id="signup-username" name="username" class="form-input" required>
                </div>
                <div class="form-group">
                    <label for="signup-password" class="form-label">Password:</label>
                    <input type="password" id="signup-password" name="password" class="form-input" required>
                </div>
                <div class="form-group">
                    <label for="signup-secQ1" class="form-label">Security question 1:</label>
                    <input type="text" id="signup-secQ1" name="signup-secQ1" class="form-input" required>
                </div>
                <div class="form-group">
                    <label for="signup-secQ1-answer" class="form-label">Answer:</label>
                    <input type="text" id="signup-secQ1-answer" name="signup-secQ1-answer" class="form-input" required>
                </div>
                <div class="form-group">
                    <label for="signup-secQ2" class="form-label">Security question 2:</label>
                    <input type="text" id="signup-secQ2" name="signup-secQ2" class="form-input" required>
                </div>
                <div class="form-group">
                    <label for="signup-secQ2-answer" class="form-label">Answer:</label>
                    <input type="text" id="signup-secQ2-answer" name="signup-secQ2-answer" class="form-input" required>
                </div>
                
                
                <button type="submit" class="submit-button">Sign up</button>
            </form>
        </div>
    <?php include '../includes/footer.php'; ?>
    
    
</body>
</html>