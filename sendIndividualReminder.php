<?php
// Send an invitation email to  a professor
// to request book information 
// Admin clicks on "email" button
// not sure how to retrieve email infor 
// for particular professor
include_once('db_connection.php');

    if (isset($_GET['email'])) {  



        $to = $_GET["email"];
        $subject = 'Book list request';
        $message = 'Hi, please submit your book request. Click on this link http://localhost/login.php to complete your submission.';
        $header = "From: elilovera06@gmail.com\r\nReply-To: dbprojectfall21@gmail.com";
        $mail_sent = mail($to, $subject, $message, $header);

        mail($to, $subject, $message, $header);

        // TODO: redirect back to the page that shows the admin all the other users
    }

?> 