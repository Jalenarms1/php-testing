<?php
include '../db.php';

// Check connection
if (!$conn) {
   die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['signup-secQ1']) && isset($_POST['signup-secQ2'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $secQ1 = $_POST['signup-secQ1'];
    $secQ1A = $_POST['signup-secQ1-answer'];
    $secQ2 = $_POST['signup-secQ2'];
    $secQ2A = $_POST['signup-secQ2-answer'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT); 

    $sql = "INSERT INTO user (username, password, securityQ1, securityQ1Answer, securityQ2, securityQ2Answer)
    VALUES ('$username', '$hashed_password', '$secQ1', '$secQ1A', '$secQ2', '$secQ2A')";

    if (mysqli_query($conn, $sql)) {
        $new_user_id = mysqli_insert_id($conn);
        session_start();
        $_SESSION['user_id'] = $new_user_id;
        header('Location: /index.php');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    return;
} else {
    $username = $_POST['username'];
    
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM user WHERE username='$username'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
       $row = mysqli_fetch_assoc($result);
       $hashed_password = $row["password"];
       if (password_verify($password, $hashed_password)) {
        session_start();
        $_SESSION['user_id'] = $row['id'];
        setcookie("logged_in", true, time() + (60 * 60 * 24 * 30));
        header('Location: /index.php');
     } else {
        echo "Invalid password.";
     }
       
    } else {
       
       echo "No user found with username $username";
    }

}

mysqli_close($conn);
?>