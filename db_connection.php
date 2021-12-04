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
  else
  {
    echo "Connected to DB";
  }

?>