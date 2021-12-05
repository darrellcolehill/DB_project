<?php 
// This file creates page to enter a specific date 
// for emails to be sent.
include_once('db_connection.php');


if(isset($_GET['submit'])){
    $semester=$_GET['semester'];
    $sendEmailDate=$_GET['sendEmailDate'];
    $bookRequestDate=$_GET['bookRequestDate'];

    $sql = "INSERT INTO emaildates
              VALUES ('{$semester}','{$sendEmailDate}', '{$bookRequestDate}')";


    if($result = $conn->query($sql))
    {
        echo "Successfully created scheduled email";
    }
    else
    {
        echo "Error creating table: " . $conn->error;
    }


    echo 'Date has been submitted';
}

?>

<html>
    <head>
        <title>Schedule Email</title>
    </head>

    <body>
        <h1>Enter date for scheduled email</h1>
        <form method="GET">
            <lable>semester</lable></br>
            <input type="text" name="semester" placeholder="type semester here"/> </br></br> </br>
            <lable>Send Date</lable></br>
            <input type="date" name="sendEmailDate" placeholder="mm/dd/yyyy"/> </br></br> </br>
            <lable>Book Request Deadline</lable></br>
            <input type="date" name="bookRequestDate" placeholder="mm/dd/yyyy"/> </br></br> </br>
            <input type="submit" value="submit" name="submit"/>
        </form>
    </body>
</html>