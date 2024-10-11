<?php
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  require '../vendor/autoload.php';
  error_reporting(E_ALL);
  ini_set('display_errors', 1);

  $mail = new PHPMailer(true);

  // Server settings
  $mail->SMTPDebug = 0;                                   // Disable verbose debug output
  $mail->isSMTP();                                        // Send using SMTP
  $mail->Host       = 'smtp.gmail.com';                   // Set the SMTP server to send through
  $mail->SMTPAuth   = true;                               // Enable SMTP authentication
  $mail->Username   = 'issustylishking@gmail.com';             // Your email address
  $mail->Password   = 'vhrkzvwoxwigmhax';                // Your generated app password
  $mail->SMTPSecure = 'tls';                              // Enable TLS encryption
  $mail->Port       = 587;                                // TCP port to connect to

  // Recipients
  $mail->setFrom($_POST['email'], $_POST['name']);        // Sender's email from the form
  $mail->addAddress('mohammedsaadh97@gmail.com');            // Your email to receive messages
  // Create a formatted table for the email body
 
  $body = "
   <table style='width: 100%; border: 1px solid #ddd; border-collapse: collapse;'>
      <tr>
        <th style='border: 1px solid #ddd; padding: 8px;'>Name</th>
        <td style='border: 1px solid #ddd; padding: 8px;'>{$_POST['name']}</td>
      </tr>
      <tr>
        <th style='border: 1px solid #ddd; padding: 8px;'>Email</th>
        <td style='border: 1px solid #ddd; padding: 8px;'>{$_POST['email']}</td>
      </tr>
        <tr>
        <th style='border: 1px solid #ddd; padding: 8px;'>Mobile</th>
        <td style='border: 1px solid #ddd; padding: 8px;'>{$_POST['mobile']}</td>
      </tr>
      <tr>
        <th style='border: 1px solid #ddd; padding: 8px;'>Level</th>
        <td style='border: 1px solid #ddd; padding: 8px;'>{$_POST['subject']}</td>
      </tr>
      <tr>
        <th style='border: 1px solid #ddd; padding: 8px;'>Message</th>
        <td style='border: 1px solid #ddd; padding: 8px;'>{$_POST['message']}</td>
      </tr>
    
     
    </table>
  ";
  
  $mail->AltBody = strip_tags($mail->Body);

  // Content
  $mail->isHTML(true);                                    // Set email format to HTML
  $mail->Subject = $_POST['subject'];                     // Subject from the form
  $mail->Body    = $body;                                 // Use the table as the body
  $mail->AltBody = strip_tags($body);                     // Plain text version

  // Send email and return response as JSON
  if ($mail->send()) {
    echo json_encode(['status' => 'success', 'message' => 'Message has been sent']);
  } else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to send your message']);
  }
