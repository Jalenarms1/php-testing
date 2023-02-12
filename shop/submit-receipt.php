<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require '../phpmailer/src/Exception.php';
    require '../phpmailer/src/PHPMailer.php';
    require '../phpmailer/src/SMTP.php';
    
    $mail = new PHPMailer(true);
    $mail2 = new PHPMailer(true);

    include '../db.php';



    // Check the connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    if(isset($_POST)) {
        $data = file_get_contents("php://input");
        $postData = json_decode($data, true);
        $transactionId = $postData['transactionId'];
        $total = $postData['total'];
        $payer_email = $postData['payer_email'];
        $timestamp = $postData['timestamp'];

        $formatted_timestamp = date("m/d/Y", strtotime($timestamp));
        $formatted_time = date("h:i:s A", strtotime($timestamp));
        $message = "Dear valued customer,\n\nThank you for your recent payment of $" . $total . ".\nTransaction ID: " . $transactionId . "\n\nDate of Payment: " . $formatted_timestamp . "\nTime of Payment: " . $formatted_time . "\n\nIf you have any questions or concerns, please do not hesitate to contact us.\n\nBest regards,\nYour Support Team";
        try {
            //Server settings
            $mail->SMTPDebug = 0;                      
            $mail->isSMTP();                                           
            $mail->Host       = 'smtp.gmail.com';                    
            $mail->SMTPAuth   = true; 
            // Your Google email                                  
            $mail->Username   = 'YOUR_EMAIL'; 
            // Your app password                    
            $mail->Password   = 'YOUR_APP_PASSWORD';                               
            $mail->SMTPSecure = 'tls';         
            $mail->Port       = 587;                                    
        
            //Recipients
            $mail->setFrom('YOUR_EMAIL');
            $mail->addAddress($payer_email);
        
            // Content
            $mail->isHTML(true);                                  
            $mail->Subject = 'Payment Comfirmation';
            $mail->Body    = $message;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
            $mail->send();
            echo 'Message has been sent';

    
           
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        

    }
    

    // Close connection
    mysqli_close($conn);
?>