<?php
// Send an invitation email to  a professor
// to request book information 
// Admin clicks on "email" button
// not sure how to retrieve email infor 
// for particular professor
include('config.php');

    if (isset($_GET['email'])) {  
        $to = $_GET["email"];
        $subject = 'Book information request'
        $message = 'Hello, please submit your book request.'
        $headers = 'From: email@email.com'."\r\n".
        'Reply-to: noreply@mail.com'."\r\n".
        'X-Mailer:PHP/'.phpversion();

        mail($to, $subject, $message, $headers);

        // TODO: redirect back to the page that shows the admin all the other users
    }
}
?> 