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

  //include_once('db_connection.php');

  // sql to create users table
  $sql = "CREATE TABLE users (
    username TEXT PRIMARY KEY,
    lastname TEXT,
    email TEXT
    )";

    //echo $sql;

    
  if ($conn->("CREATE TABLE users username TEXT PRIMARY KEY") == TRUE) {
    echo "Table users created successfully";
  } else {
    echo "Error creating table: ";
  }


  /*

  // sql to create request table
  $sql = "CREATE TABLE request (
    username TEXT NOT NULL,
    semester TEXT NOT NULL,
    PRIMARY KEY (username, semester)
  )";
    
  if ($conn->query($sql) === TRUE) {
    echo "Table users created successfully";
  } else {
    echo "Error creating table: " . $conn->error;
  }


  // sql to create books table
  $sql = "CREATE TABLE books (
    username TEXT NOT NULL,
    semester TEXT NOT NULL,
    ISBN TEXT NOT NULL,
    title TEXT,
    authors TEXT,
    edition TEXT,
    publisher TEXT,
    PRIMARY KEY (username, semester)
  )";
    
  if ($conn->query($sql) === TRUE) {
    echo "Table users created successfully";
  } else {
    echo "Error creating table: " . $conn->error;
  }
  */


?>