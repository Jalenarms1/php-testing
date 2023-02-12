<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';

$mail = new PHPMailer(true);
$mail2 = new PHPMailer(true);

include '../db.php';
// Check connection
if (!$conn) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_POST['replyConsent']) && $_POST['replyConsent'] === 'on') {
    $consent = 1;
} else {
    $consent = 0;
}


$salutation = $_POST["salutation"];
$first_name = $_POST["first-name"];
$last_name = $_POST["last-name"];
$phone = $_POST["phone"];
$email = $_POST["email"];
$subject = $_POST["subject"];
$comments = $_POST["comments"];
$createdAt = date("Y-m-d H:i:s", time());

$sql = "INSERT INTO feedback (salutation, firstName, lastName, phone, email, subject, comments, replyConsent, createdAt)
VALUES ('$salutation', '$first_name', '$last_name', '$phone', '$email', '$subject', '$comments', $consent, '$createdAt')";

if ($conn->query($sql) === TRUE) {
    try {
        //Server settings
        $mail->SMTPDebug = 0;                      
        $mail->isSMTP();                                           
        $mail->Host       = 'smtp.gmail.com';                    
        $mail->SMTPAuth   = true;       
        // YOUR email                            
        $mail->Username   = 'YOUR_EMAIL'; 
        // Your google app password                    
        $mail->Password   = 'YOUR_APP_PASSWORD';                               
        $mail->SMTPSecure = 'tls';         
        $mail->Port       = 587;                                    
    
        //Recipients
        $mail->setFrom('YOUR_EMAIL');
        $mail->addAddress('YOUR_EMAIL');
    
        // Content
        $mail->isHTML(true);                                  
        $mail->Subject = $subject;
        $mail->Body    = $comments;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
        $mail->send();
        echo 'Message has been sent';
        
        if (isset($_POST['replyConsent']) && $_POST['replyConsent'] === 'on') {
            $consent = true;
            $mail2->SMTPDebug = 0;                      
            $mail2->isSMTP();                                            
            $mail2->Host       = 'smtp.gmail.com';                    
            $mail2->SMTPAuth   = true;    
            //Your Google email                               
            $mail2->Username   = 'YOUR_EMAIL';    
            //Your app password                 
            $mail2->Password   = 'YOUR_APP_PASSWORD';                               
            $mail2->SMTPSecure = 'tls';         
            $mail2->Port       = 587;                                    
        
            //Recipients
            $mail2->setFrom('YOUR_EMAIL');
            $mail2->addAddress($email, "$salutation $first_name $last_name");     
        
            // Content
            $mail2->isHTML(true);                                  
            $mail2->Subject = 'Feedback recorded';
            $mail2->Body    = 'Your feedback has been submitted. Thank you for your time and consideration!';
            $mail2->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
            $mail2->send();
            echo 'Message has been sent';
            
        } else {
            $consent = false;
        }

       
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>
