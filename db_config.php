<?php
  include_once('db_connection.php');

  // sql to create users table
  $sql = "CREATE TABLE IF NOT EXISTS users (
    username VARCHAR(30),
    password VARCHAR(30),
    lastname VARCHAR(30),
    email VARCHAR(30),
    admin BOOLEAN,
    PRIMARY KEY (username)
    )";

    //echo $sql;

    
  if ($conn->query($sql) === TRUE) {
    echo "Table users created successfully";
  } else {
    echo $conn->error;
  }


  

  // sql to create request table
  $sql = "CREATE TABLE IF NOT EXISTS request (
    username VARCHAR(30),
    semester VARCHAR(30),
    PRIMARY KEY (username, semester)
  )";
    
  if ($conn->query($sql) === TRUE) {
    echo "Table users created successfully";
  } else {
    echo "Error creating table: " . $conn->error;
  }


  // sql to create books table
  $sql = "CREATE TABLE IF NOT EXISTS books (
    username VARCHAR(30),
    semester VARCHAR(30),
    ISBN VARCHAR(30),
    title VARCHAR(30),
    authors VARCHAR(30),
    edition VARCHAR(30),
    publisher VARCHAR(30),
    PRIMARY KEY (username, semester, ISBN)
  )";
    
  if ($conn->query($sql) === TRUE) {
    echo "Table users created successfully";
  } else {
    echo "Error creating table: " . $conn->error;
  }
  


?>