<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'includes/PHPMailer.php';
require 'includes/SMTP.php';
require 'includes/Exception.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Loginid = $_POST['Loginid'];
    $Username = $_POST['Username'];
    $Email = $_POST['Email'];
    $Department = $_POST['Department'];
    $Password = $_POST['Password'];
    $Message = 'You have logged in successfully.';

    $dbuser = 'root';
    $pass = '';
    $db = 'gmrlogin';

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Set up SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';  // Replace with your SMTP server address
        $mail->SMTPAuth = true;
        $mail->Username = 'wdev305@gmail.com';  // Replace with your email address
        $mail->Password = 'gxgbesjigwpwpcoz';  // Replace with your email password
        $mail->SMTPSecure = 'tls';  // Set encryption type: 'tls' or 'ssl'
        $mail->Port = 587;  // Set the SMTP port number

        // Set email parameters
        $mail->setFrom('wdev305@gmail.com', 'GMR');  // Replace with your email address and name

        // Connect to the database
        $db = new mysqli('127.0.0.1:3308', $dbuser, $pass, $db);

        // Check if the connection was successful
        if ($db->connect_errno) {
            throw new Exception('Failed to connect to the database: ' . $db->connect_error);
        }

        // Save inputs into the database
        $query = "INSERT INTO login_g (Loginid, Username, Email, Department, Password) 
                  VALUES ('$Loginid', '$Username', '$Email', '$Department', '$Password')";

        if ($db->query($query) === false) {
            throw new Exception('Failed to save data to the database: ' . $db->error);
        }

        // Retrieve recipient email addresses from the database table
        $result = $db->query("SELECT `Email` FROM `login_g`");
        $recipientEmails = [];

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $recipientEmails[] = $row['Email'];
            }
            $result->free();
        } else {
            throw new Exception('Failed to retrieve recipient email addresses: ' . $db->error);
        }

        // Loop through recipient email addresses and send individual emails
        foreach ($recipientEmails as $recipientEmail) {
            $mail->addAddress($recipientEmail);  // Add recipient email address

            $mail->Subject = 'This is a test mail';
            $mail->Body = "Name: $Username\nEmail: $Email\nMessage: $Message";

            // Send the email
            $mail->send();

            // Clear recipients for the next iteration
            $mail->ClearAddresses();
        }

        echo 'Your email has been sent successfully and data has been saved to the database.';
    } catch (Exception $e) {
        echo 'Sorry, there was an error sending your email or saving data to the database.';
        echo 'Error: ' . $e->getMessage();
    } finally {
        // Close the database connection
        if ($db) {
            $db->close();
        }
    }
}
header("Location: ../gmr_login_form.php?login=success");
?>

