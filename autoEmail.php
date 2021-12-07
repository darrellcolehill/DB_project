<?php
//include_once('db_connection.php');

// Reads current time
date_default_timezone_set('America/New_York');
$date = date('Y-m-d');
//echo $date;

//$result = $conn->query("UPDATE emaildates SET sentStatus = 1, sendEmailDate = '0000-00-00' WHERE sendEmailDate = '{$date}' AND sentStatus = 0") ;
$result = $conn->query("SELECT COUNT(*) as count FROM emaildates WHERE sendEmailDate = '{$date}' AND sentStatus = 0") ;

/*
$count = 0;
while ($row = $result->fetch_assoc()) {
    $sendEmailDate = $row['sendEmailDate'];
    $bookRequestDate = $row['bookRequestDate'];
        
    $count += 1;   
}
*/

//echo mysqli_affected_rows($conn);

//if(mysqli_affected_rows($conn))
$row = $result->fetch_assoc();
echo $row['count'];
if($row['count'] > 0)
{

    $result2 = $conn->query("SELECT bookRequestDate FROM emaildates WHERE sendEmailDate = '{$date}' AND sentStatus = 0");

    $result = $conn->query("UPDATE emaildates SET sentStatus = 1, sendEmailDate = '0000-00-00' WHERE sendEmailDate = '{$date}' AND sentStatus = 0") ;

    $row = $result2->fetch_assoc();

    $bookRequestDate = $row['bookRequestDate'];


    $result3 = $conn->query("SELECT * FROM users WHERE admin = 0");

    while($row3 = $result3->fetch_assoc()) {
        $email = $row3['email'];

        $to = $email;
        $subject = 'Book request reminder';
        $message = 'Please submit your book request by '.$bookRequestDate.'.';
        $headers = 'From: dbprojectfall21@gmail.com' . "\r\n" .
        'Reply-To: dbprojectfall21@gmail.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

        mail($to, $subject, $message, $headers);
    }

}


//echo $result;

?>


