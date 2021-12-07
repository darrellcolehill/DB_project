<?php
  include_once('db_connection.php');

  // sql to create users table
  $sql = "CREATE TABLE IF NOT EXISTS users (
    password VARCHAR(30),
    name VARCHAR(30),
    email VARCHAR(30),
    admin BOOLEAN DEFAULT 0,
    PRIMARY KEY (email)
    )";

    //echo $sql;

    
  if ($conn->query($sql) === TRUE) {
    echo "Table users created successfully";
  } else {
    echo $conn->error;
  }


  // sql to create request table
  $sql = "CREATE TABLE IF NOT EXISTS request (
    email VARCHAR(30),
    semester VARCHAR(30),
    PRIMARY KEY (email, semester)
  )";
    

  if ($conn->query($sql) === TRUE) {
    echo "Table request created successfully";
  } else {
    echo "Error creating table: " . $conn->error;
  }


  // sql to create books table
  $sql = "CREATE TABLE IF NOT EXISTS books (
    email VARCHAR(30),
    semester VARCHAR(30),
    ISBN VARCHAR(30),
    class VARCHAR(30),
    title VARCHAR(30),
    authors VARCHAR(30),
    edition VARCHAR(30),
    publisher VARCHAR(30),
    count INT,
    PRIMARY KEY (email, semester, ISBN, Class),
    FOREIGN KEY (email, semester) REFERENCES request(email, semester) ON DELETE CASCADE
  )";
    
    
  if ($conn->query($sql) === TRUE) {
    echo "Table books created successfully";
  } else {
    echo "Error creating table: " . $conn->error;
  }
 

  // sql to create books table
  $sql = "CREATE TABLE IF NOT EXISTS emaildates (
    semester VARCHAR(30),
    sendEmailDate DATE,
    bookRequestDate DATE,
    sentStatus BOOLEAN DEFAULT 0
  )";
    
    
  if ($conn->query($sql) === TRUE) {
    echo "Table emaildates created successfully";
  } else {
    echo "Error creating table: " . $conn->error;
  }

?>