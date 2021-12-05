<?php
// This email is sent by staff to ask the professors 
// to submit their book requests by a certain deadline
//include('db_config.php');

include_once('db_connection.php');



if(isset($_GET['submit']))
{
    // Not sure what the name of the table is. Used "professors"
    // as place holder
    $result = $conn->query("SELECT * FROM users WHERE admin = 0") ;
    while ($row = $result->fetch_assoc()) {
        // Assuming these are the names of each column
        $email=$row['email'];
        
        $date = $_GET["date"];

        // Table may need to include an arbitrary date column for 
        // each semester's book list to be submitted.
        $to = $email;
        $subject = 'Book list request';
        $message = 'Hi, we need your book requests!';
        $message = 'Must be submitted by: ' . $date;
        $headers = 'From: staff@ucf.edu' . "\r\n" .
        'Reply-To: noreply@ucf.edu' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

        mail($to, $subject, $message, $headers);

        // create a column that contains a semester flag then if loop 
        // will update the flag to determine date
    }
}

?>



<html>
    <head>
        <title>Broadcast emali</title>
    </head>

    <body>
        <h1>Enter date for broadcast email</h1>
        <form method="GET" action="">
            <input type="date" name="date" placeholder="mm/dd/yyyy"/>
            <input type="submit" value="submit" name="submit"/>
        </form>
    </body>
</html>
