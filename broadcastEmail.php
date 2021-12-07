<?php
// This email is sent by staff to ask the professors 
// to submit their book requests by a certain deadline
//include('db_config.php');

include_once('db_connection.php');



    if(isset($_GET['submit']))
    {
        $date = $_GET["date"];
        $count = 0;
        // Not sure what the name of the table is. Used "professors"
        // as place holder
        $result = $conn->query("SELECT * FROM users WHERE admin = 0") ;
        while ($row = $result->fetch_assoc()) {
            // Assuming these are the names of each column
            $email=$row['email'];

            // Table may need to include an arbitrary date column for 
            // each semester's book list to be submitted.

            $to = $email;
            $subject = 'Book list request';
            $message = 'Hi, we need your book requests by '.$date;
            $header = "From: elilovera06@gmail.com\r\nReply-To: elilovera06@gmail.com";
            $mail_sent = mail($to, $subject, $message, $header);
            
        }
        echo 'Email sent successfully!';
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
