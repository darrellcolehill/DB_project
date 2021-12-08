<?php

  // NOTE: may need to change
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "db_project";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }


  // Uncommenting the code below will configure
  // the auto email function. Once db_config.php
  // is ran, this can be uncommented.
  /*
    
  // Reads current time
  date_default_timezone_set('America/New_York');
  $date = date('Y-m-d');
  //echo $date;

  //$result = $conn->query("UPDATE emaildates SET sentStatus = 1, sendEmailDate = '0000-00-00' WHERE sendEmailDate = '{$date}' AND sentStatus = 0") ;
  $result = $conn->query("SELECT COUNT(*) as count FROM emaildates WHERE sendEmailDate = '{$date}' AND sentStatus = 0") ;

  
  

  
  $row = $result->fetch_assoc();
  //echo $row['count'];
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
          $headers = 'From: elilovera06@gmail.com' . "\r\n" .
          'Reply-To: elilovera06@gmail.com' . "\r\n" .
          'X-Mailer: PHP/' . phpversion();

          mail($to, $subject, $message, $headers);
      }

  }
*/

?>