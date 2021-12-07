<?php
include_once('db_connection.php');

// Reads current time
date_default_timezone_set('America/New_York');
$date = date('m/d/Y');
echo $date;

$result = $conn->query("SELECT * FROM emaildates") ;
while ($row = $result->fetch_assoc()) {
    $sendEmailDate = $_GET['sendEmailDate'];
    $bookRequestDate = $_GET['bookRequestDate'];

    if($date = $sendEmailDate) {
        $result2 = $conn->query("SELECT * FROM users WHERE admin FALSE");
        while($row2 = $result2->fetch_assoc()) {
            $email = $row2['email'];

            $to = $email;
            $subject = 'Book request reminder';
            $message = 'Please submit your book request by '.$bookRequestDate.'.'
            $headers = 'From: dbprojectfall21@gmail.com' . "\r\n" .
            'Reply-To: dbprojectfall21@gmail.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
    
            mail($to, $subject, $message, $headers);
    
           
        }
    
        
    }
}

?>


